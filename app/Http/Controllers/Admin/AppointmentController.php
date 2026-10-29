<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'status' => ['nullable', Rule::in([
                'pending', 'confirmed', 'completed',
                'cancelled', 'no_show'
            ])],
            'date' => ['nullable', 'date_format:Y-m-d'],
        ]);

        $query = Appointment::with('service');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date')) {
            $query->whereDate('appointment_at', $request->date);
        }

        $appointments = $query
            ->orderBy('appointment_at')
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => Appointment::count(),
            'today' => Appointment::whereDate(
                'appointment_at', today()
            )->count(),
            'pending' => Appointment::where(
                'status', 'pending'
            )->count(),
            'confirmed' => Appointment::where(
                'status', 'confirmed'
            )->count(),
        ];

        return view('admin.appointments.index',
            compact('appointments', 'stats'));
    }

    public function create()
    {
        $services = Service::where('is_active', true)
            ->orderBy('name')->get();

        return view('admin.appointments.create',
            compact('services'));
    }

    public function store(Request $request)
    {
        $data = $this->validateAppointment($request);

        DB::transaction(function () use ($data) {
            $this->saveAppointment($data);
        });

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment created successfully.');
    }

    public function edit(Appointment $appointment)
    {
        $services = Service::orderBy('name')->get();

        return view('admin.appointments.edit',
            compact('appointment', 'services'));
    }

    public function update(
        Request $request,
        Appointment $appointment
    ) {
        $data = $this->validateAppointment($request);

        DB::transaction(function () use ($data, $appointment) {
            $this->saveAppointment($data, $appointment);
        });

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();

        return redirect()
            ->route('admin.appointments.index')
            ->with('success', 'Appointment deleted.');
    }

    private function validateAppointment(Request $request): array
    {
        return $request->validate([
            'service_id' => [
                'required',
                Rule::exists('services', 'id'),
            ],
            'customer_name' => [
                'required', 'string', 'max:255'
            ],
            'customer_phone' => [
                'required', 'string', 'max:20'
            ],
            'customer_email' => [
                'nullable', 'email', 'max:255'
            ],
            'appointment_at' => [
                'required', 'date_format:Y-m-d\TH:i'
            ],
            'status' => [
                'required',
                Rule::in([
                    'pending', 'confirmed', 'completed',
                    'cancelled', 'no_show'
                ]),
            ],
            'notes' => ['nullable', 'string', 'max:5000'],
        ]);
    }

    private function saveAppointment(
        array $data,
        ?Appointment $appointment = null
    ): void {
        // Serialize booking changes using the existing
        // singleton website settings row.
        $settings = DB::table('website_settings')
            ->where('id', 1)
            ->lockForUpdate()
            ->first();

        if (!$settings) {
            throw ValidationException::withMessages([
                'appointment_at' =>
                    'Website settings must be configured first.',
            ]);
        }

        $service = Service::findOrFail($data['service_id']);

        if (!$appointment && !$service->is_active) {
            throw ValidationException::withMessages([
                'service_id' => 'Select an active service.',
            ]);
        }

        $start = Carbon::createFromFormat(
            'Y-m-d\TH:i',
            $data['appointment_at']
        );

        $duration = (int) $service->duration_minutes;

        if ($duration <= 0) {
            throw ValidationException::withMessages([
                'service_id' => 'Service duration is invalid.',
            ]);
        }

        $end = $start->copy()->addMinutes($duration);

        if ($start->lt(now())) {
            throw ValidationException::withMessages([
                'appointment_at' =>
                    'Appointment must be in the future.',
            ]);
        }

        $opening = Carbon::parse(
            $start->format('Y-m-d') . ' ' .
            config('salon.opening_time', '09:00')
        );

        $closing = Carbon::parse(
            $start->format('Y-m-d') . ' ' .
            config('salon.closing_time', '20:00')
        );

        if ($start->lt($opening) || $end->gt($closing)) {
            throw ValidationException::withMessages([
                'appointment_at' =>
                    'Booking must fit within salon working hours.',
            ]);
        }

        if (in_array($data['status'], [
            'pending', 'confirmed'
        ], true)) {
            $capacity = max(
                1,
                (int) config(
                    'salon.max_simultaneous_appointments', 3
                )
            );

            // Count every overlapping booking, not only
            // bookings with the same starting time.
            $existing = Appointment::whereIn('status', [
                    'pending', 'confirmed'
                ])
                ->when($appointment, function ($query) use ($appointment) {
                    $query->where('id', '!=', $appointment->id);
                })
                ->where('appointment_at', '<', $end)
                ->whereRaw(
                    'DATE_ADD(appointment_at, INTERVAL duration_minutes MINUTE) > ?',
                    [$start->format('Y-m-d H:i:s')]
                )
                ->get(['appointment_at', 'duration_minutes']);

            // Capacity must hold at every point in the
            // requested appointment interval.
            $events = [
                [$start->timestamp, 1],
                [$end->timestamp, -1],
            ];

            foreach ($existing as $item) {
                $itemStart = $item->appointment_at;
                $itemEnd = $itemStart->copy()
                    ->addMinutes($item->duration_minutes);

                $events[] = [
                    max($start->timestamp, $itemStart->timestamp),
                    1,
                ];

                $events[] = [
                    min($end->timestamp, $itemEnd->timestamp),
                    -1,
                ];
            }

            usort($events, function ($a, $b) {
                return ($a[0] <=> $b[0])
                    ?: ($a[1] <=> $b[1]);
            });

            $concurrent = 0;

            foreach ($events as [$time, $change]) {
                $concurrent += $change;

                if ($concurrent > $capacity) {
                    throw ValidationException::withMessages([
                        'appointment_at' =>
                            'Booking capacity is full for this time.',
                    ]);
                }
            }
        }

        $data['appointment_at'] = $start;
        $data['duration_minutes'] = $duration;

        if ($appointment) {
            $appointment->update($data);
        } else {
            $data['booking_source'] = 'admin';
            Appointment::create($data);
        }
    }
}
