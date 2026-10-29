
@php
    $appointment = $appointment ?? null;

    $input = 'min-h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-brand focus:ring-2 focus:ring-red-100';

    $selectedDate = old(
        'appointment_at',
        $appointment?->appointment_at?->format('Y-m-d\TH:i')
    );

    $statuses = [
        'pending' => 'Pending',
        'confirmed' => 'Confirmed',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'no_show' => 'No Show',
    ];
@endphp

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">

    <div>
        <label for="customer_name" class="mb-2 block text-sm font-semibold text-slate-700">
            Customer Name *
        </label>
        <input id="customer_name" name="customer_name" required maxlength="255"
               value="{{ old('customer_name', $appointment?->customer_name) }}"
               placeholder="Enter customer name"
               class="{{ $input }}">
    </div>

    <div>
        <label for="customer_phone" class="mb-2 block text-sm font-semibold text-slate-700">
            Mobile Number *
        </label>
        <input id="customer_phone" name="customer_phone" type="tel"
               required maxlength="20"
               value="{{ old('customer_phone', $appointment?->customer_phone) }}"
               placeholder="+91 9876543210"
               class="{{ $input }}">
    </div>

    <div>
        <label for="customer_email" class="mb-2 block text-sm font-semibold text-slate-700">
            Email Address
        </label>
        <input id="customer_email" name="customer_email" type="email"
               maxlength="255"
               value="{{ old('customer_email', $appointment?->customer_email) }}"
               placeholder="customer@example.com"
               class="{{ $input }}">
    </div>

    <div>
        <label for="service_id" class="mb-2 block text-sm font-semibold text-slate-700">
            Select Service *
        </label>
        <select id="service_id" name="service_id" required class="{{ $input }}">
            <option value="">Choose Salon Service</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}"
                    @selected(old('service_id', $appointment?->service_id) == $service->id)>
                    {{ $service->name }} — {{ $service->duration_minutes }} min
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="appointment_at" class="mb-2 block text-sm font-semibold text-slate-700">
            Appointment Date & Time *
        </label>
        <input id="appointment_at" name="appointment_at"
               type="datetime-local" required
               value="{{ $selectedDate }}"
               class="{{ $input }}">
        <p class="mt-1 text-xs text-slate-500">
            Choose a future date within salon working hours.
        </p>
    </div>

    <div>
        <label for="status" class="mb-2 block text-sm font-semibold text-slate-700">
            Booking Status *
        </label>
        <select id="status" name="status" class="{{ $input }}">
            @foreach($statuses as $value => $label)
                <option value="{{ $value }}"
                    @selected(old('status', $appointment?->status ?? 'pending') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="md:col-span-2">
        <label for="notes" class="mb-2 block text-sm font-semibold text-slate-700">
            Appointment Notes
        </label>
        <textarea id="notes" name="notes" rows="4"
                  maxlength="5000"
                  placeholder="Customer preferences or special instructions..."
                  class="{{ $input }}">{{ old('notes', $appointment?->notes) }}</textarea>
    </div>
</div>

<div class="mt-7 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
    <a href="{{ route('admin.appointments.index') }}"
       class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-200 px-6 text-sm font-semibold text-slate-700">
        Cancel
    </a>

    <button type="submit"
            class="min-h-11 rounded-xl bg-brand px-6 text-sm font-semibold text-white transition hover:bg-brand-dark">
        {{ $appointment ? 'Update Appointment' : 'Create Appointment' }}
    </button>
</div>
