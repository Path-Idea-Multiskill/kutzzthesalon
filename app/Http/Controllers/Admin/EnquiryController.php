<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnquiryController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'status' => [
                'nullable',
                Rule::in([
                    'new', 'contacted', 'follow_up',
                    'converted', 'closed'
                ]),
            ],
            'type' => [
                'nullable',
                Rule::in([
                    'general', 'service', 'academy',
                    'bridal', 'other'
                ]),
            ],
            'search' => ['nullable', 'string', 'max:100'],
        ]);

        $query = Enquiry::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $enquiries = $query->latest()
            ->paginate(15)
            ->withQueryString();

        $stats = [
            'total' => Enquiry::count(),
            'new' => Enquiry::where('status', 'new')->count(),
            'follow_up' => Enquiry::where('status', 'follow_up')->count(),
            'converted' => Enquiry::where('status', 'converted')->count(),
        ];

        return view('admin.enquiries.index',
            compact('enquiries', 'stats'));
    }

    public function create()
    {
        return view('admin.enquiries.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['source'] = 'admin';

        Enquiry::create($data);

        return redirect()
            ->route('admin.enquiries.index')
            ->with('success', 'Enquiry created successfully.');
    }

    public function edit(Enquiry $enquiry)
    {
        return view('admin.enquiries.edit', compact('enquiry'));
    }

    public function update(Request $request, Enquiry $enquiry)
    {
        $data = $this->validatedData($request);

        $enquiry->update($data);

        return redirect()
            ->route('admin.enquiries.index')
            ->with('success', 'Enquiry updated successfully.');
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return back()->with('success', 'Enquiry deleted.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'type' => [
                'required',
                Rule::in([
                    'general', 'service', 'academy',
                    'bridal', 'other'
                ]),
            ],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['nullable', 'string', 'max:10000'],
            'status' => [
                'required',
                Rule::in([
                    'new', 'contacted', 'follow_up',
                    'converted', 'closed'
                ]),
            ],
            'admin_notes' => ['nullable', 'string', 'max:10000'],
            'follow_up_at' => ['nullable', 'date'],
        ]);
    }
}
