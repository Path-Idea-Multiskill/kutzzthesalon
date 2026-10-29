@php
    $enquiry = $enquiry ?? null;

    $input = 'min-h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-brand focus:ring-2 focus:ring-red-100';

    $types = [
        'general' => 'General Enquiry',
        'service' => 'Salon Service',
        'academy' => 'Academy Admission',
        'bridal' => 'Bridal Package',
        'other' => 'Other',
    ];

    $statuses = [
        'new' => 'New',
        'contacted' => 'Contacted',
        'follow_up' => 'Follow Up',
        'converted' => 'Converted',
        'closed' => 'Closed',
    ];
@endphp

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">

    <div>
        <label for="name" class="mb-2 block text-sm font-semibold">
            Customer Name *
        </label>
        <input id="name" name="name" required maxlength="255" value="{{ old('name', $enquiry?->name) }}"
            placeholder="Customer full name" class="{{ $input }}">
    </div>

    <div>
        <label for="phone" class="mb-2 block text-sm font-semibold">
            Mobile Number *
        </label>
        <input id="phone" name="phone" type="tel" required maxlength="20" value="{{ old('phone', $enquiry?->phone) }}"
            placeholder="+91 9876543210" class="{{ $input }}">
    </div>

    <div>
        <label for="email" class="mb-2 block text-sm font-semibold">
            Email Address
        </label>
        <input id="email" name="email" type="email" maxlength="255" value="{{ old('email', $enquiry?->email) }}"
            placeholder="customer@example.com" class="{{ $input }}">
    </div>

    <div>
        <label for="type" class="mb-2 block text-sm font-semibold">
            Enquiry Type *
        </label>
        <select id="type" name="type" class="{{ $input }}">
            @foreach($types as $value => $label)
                <option value="{{ $value }}" @selected(old('type', $enquiry?->type ?? 'general') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="md:col-span-2">
        <label for="subject" class="mb-2 block text-sm font-semibold">
            Subject
        </label>
        <input id="subject" name="subject" maxlength="255" value="{{ old('subject', $enquiry?->subject) }}"
            placeholder="e.g. Bridal Makeup Package Enquiry" class="{{ $input }}">
    </div>

    <div class="md:col-span-2">
        <label for="message" class="mb-2 block text-sm font-semibold">
            Customer Message
        </label>
        <textarea id="message" name="message" rows="4" maxlength="10000" placeholder="Customer enquiry details..."
            class="{{ $input }}">{{ old('message', $enquiry?->message) }}</textarea>
    </div>

    <div>
        <label for="status" class="mb-2 block text-sm font-semibold">
            Enquiry Status *
        </label>
        <select id="status" name="status" class="{{ $input }}">
            @foreach($statuses as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $enquiry?->status ?? 'new') === $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="follow_up_at" class="mb-2 block text-sm font-semibold">
            Next Follow-Up
        </label>
        <input id="follow_up_at" name="follow_up_at" type="datetime-local"
            value="{{ old('follow_up_at', $enquiry?->follow_up_at?->format('Y-m-d\TH:i')) }}" class="{{ $input }}">
    </div>

    <div class="md:col-span-2">
        <label for="admin_notes" class="mb-2 block text-sm font-semibold">
            Internal Admin Notes
        </label>
        <textarea id="admin_notes" name="admin_notes" rows="4" maxlength="10000"
            placeholder="Add follow-up notes or customer preferences..."
            class="{{ $input }}">{{ old('admin_notes', $enquiry?->admin_notes) }}</textarea>
    </div>
</div>

<div class="mt-7 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
    <a href="{{ route('admin.enquiries.index') }}"
        class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-200 px-6 text-sm font-semibold">
        Cancel
    </a>

    <button type="submit" class="min-h-11 rounded-xl bg-brand px-6 text-sm font-semibold text-white">
        {{ $enquiry ? 'Update Enquiry' : 'Create Enquiry' }}
    </button>
</div>