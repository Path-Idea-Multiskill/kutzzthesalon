
@php
    $branch = $branch ?? null;

    $input = 'min-h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-brand focus:ring-2 focus:ring-red-100';
@endphp

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">

    <div class="md:col-span-2">
        <h2 class="mb-1 font-heading text-lg font-bold text-slate-900">
            Branch Information
        </h2>
        <p class="mb-2 text-xs text-slate-500">
            Enter salon branch details and location.
        </p>
    </div>

    <div>
        <label for="name" class="mb-2 block text-sm font-semibold">
            Branch Name *
        </label>
        <input id="name" name="name" required maxlength="255"
               value="{{ old('name', $branch?->name) }}"
               placeholder="Kutz Salon - Main Branch"
               class="{{ $input }}">
    </div>

    <div>
        <label for="city" class="mb-2 block text-sm font-semibold">
            City *
        </label>
        <input id="city" name="city" required maxlength="255"
               value="{{ old('city', $branch?->city) }}"
               placeholder="Bhilai"
               class="{{ $input }}">
    </div>

    <div>
        <label for="state" class="mb-2 block text-sm font-semibold">
            State
        </label>
        <input id="state" name="state" maxlength="255"
               value="{{ old('state', $branch?->state) }}"
               placeholder="Chhattisgarh"
               class="{{ $input }}">
    </div>

    <div>
        <label for="pincode" class="mb-2 block text-sm font-semibold">
            PIN Code
        </label>
        <input id="pincode" name="pincode" maxlength="15"
               value="{{ old('pincode', $branch?->pincode) }}"
               placeholder="490001"
               class="{{ $input }}">
    </div>

    <div class="md:col-span-2">
        <label for="address" class="mb-2 block text-sm font-semibold">
            Complete Address *
        </label>
        <textarea id="address" name="address" required rows="3"
                  maxlength="2000"
                  placeholder="Enter full salon branch address"
                  class="{{ $input }}">{{ old('address', $branch?->address) }}</textarea>
    </div>

    <div>
        <label for="phone" class="mb-2 block text-sm font-semibold">
            Contact Number *
        </label>
        <input id="phone" name="phone" type="tel" required maxlength="20"
               value="{{ old('phone', $branch?->phone) }}"
               placeholder="+91 9876543210"
               class="{{ $input }}">
    </div>

    <div>
        <label for="alternate_phone" class="mb-2 block text-sm font-semibold">
            Alternate Number
        </label>
        <input id="alternate_phone" name="alternate_phone" type="tel"
               maxlength="20"
               value="{{ old('alternate_phone', $branch?->alternate_phone) }}"
               class="{{ $input }}">
    </div>

    <div>
        <label for="email" class="mb-2 block text-sm font-semibold">
            Email Address
        </label>
        <input id="email" name="email" type="email" maxlength="255"
               value="{{ old('email', $branch?->email) }}"
               placeholder="branch@example.com"
               class="{{ $input }}">
    </div>

    <div>
        <label for="google_maps_url" class="mb-2 block text-sm font-semibold">
            Google Maps URL
        </label>
        <input id="google_maps_url" name="google_maps_url" type="url"
               value="{{ old('google_maps_url', $branch?->google_maps_url) }}"
               placeholder="https://maps.google.com/..."
               class="{{ $input }}">
    </div>

    <div class="md:col-span-2 border-t border-slate-100 pt-5">
        <h2 class="font-heading text-lg font-bold text-slate-900">
            Working Hours
        </h2>
    </div>

    <div>
        <label for="opening_time" class="mb-2 block text-sm font-semibold">
            Opening Time
        </label>
        <input id="opening_time" name="opening_time" type="time"
               value="{{ old('opening_time', $branch?->opening_time) }}"
               class="{{ $input }}">
    </div>

    <div>
        <label for="closing_time" class="mb-2 block text-sm font-semibold">
            Closing Time
        </label>
        <input id="closing_time" name="closing_time" type="time"
               value="{{ old('closing_time', $branch?->closing_time) }}"
               class="{{ $input }}">
    </div>

    <div class="md:col-span-2">
        <label for="working_days" class="mb-2 block text-sm font-semibold">
            Working Days
        </label>
        <input id="working_days" name="working_days" maxlength="255"
               value="{{ old('working_days', $branch?->working_days) }}"
               placeholder="Monday - Sunday"
               class="{{ $input }}">
    </div>

    <div class="md:col-span-2 border-t border-slate-100 pt-5">
        <h2 class="font-heading text-lg font-bold text-slate-900">
            Branch Cover Image
        </h2>
    </div>

    <div class="md:col-span-2">
        <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-6 text-center sm:p-8">

            <div id="branchPreviewWrapper"
                 class="{{ $branch?->image ? '' : 'hidden' }} mb-4">
                <img id="branchPreview"
                     src="{{ $branch?->image ? asset('storage/' . $branch->image) : '' }}"
                     alt="Branch image preview"
                     class="mx-auto aspect-video w-full max-w-sm rounded-xl object-cover">
            </div>

            <p class="mb-3 text-3xl">📷</p>
            <p class="mb-4 text-sm text-slate-500">
                JPG, PNG, WebP — Maximum 2 MB
            </p>

            <label for="branchImage"
                   class="inline-flex min-h-11 cursor-pointer items-center justify-center rounded-xl bg-brand px-6 text-sm font-semibold text-white">
                Choose Branch Image
            </label>

            <input id="branchImage" name="image" type="file"
                   accept=".jpg,.jpeg,.png,.webp"
                   class="sr-only">

            <p id="branchImageName" class="mt-3 text-xs text-slate-500">
                No new image selected
            </p>
        </div>
    </div>

    <div>
        <label for="sort_order" class="mb-2 block text-sm font-semibold">
            Sort Order
        </label>
        <input id="sort_order" name="sort_order" type="number"
               min="0" required
               value="{{ old('sort_order', $branch?->sort_order ?? 0) }}"
               class="{{ $input }}">
    </div>

    <div>
        <label for="is_active" class="mb-2 block text-sm font-semibold">
            Branch Status
        </label>
        <select id="is_active" name="is_active" class="{{ $input }}">
            <option value="1" @selected((string) old('is_active', (int) ($branch?->is_active ?? true)) === '1')>
                Active
            </option>
            <option value="0" @selected((string) old('is_active', (int) ($branch?->is_active ?? true)) === '0')>
                Inactive
            </option>
        </select>
    </div>

    <div class="md:col-span-2">
        <label for="is_primary" class="mb-2 block text-sm font-semibold">
            Primary Branch
        </label>
        <select id="is_primary" name="is_primary" class="{{ $input }}">
            <option value="0" @selected((string) old('is_primary', (int) ($branch?->is_primary ?? false)) === '0')>
                No
            </option>
            <option value="1" @selected((string) old('is_primary', (int) ($branch?->is_primary ?? false)) === '1')>
                Yes — Set as Main Branch
            </option>
        </select>
    </div>
</div>

<div class="mt-7 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
    <a href="{{ route('admin.branches.index') }}"
       class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-200 px-6 text-sm font-semibold">
        Cancel
    </a>

    <button type="submit"
            class="min-h-11 rounded-xl bg-brand px-6 text-sm font-semibold text-white hover:bg-brand-dark">
        {{ $branch ? 'Update Branch' : 'Save Branch' }}
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('branchImage');
    const preview = document.getElementById('branchPreview');
    const wrapper = document.getElementById('branchPreviewWrapper');
    const name = document.getElementById('branchImageName');

    input.addEventListener('change', function () {
        const file = this.files && this.files[0];

        if (!file) return;

        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)
            || file.size > 2 * 1024 * 1024) {
            alert('Please select a JPG, PNG or WebP image under 2 MB.');
            this.value = '';
            return;
        }

        const url = URL.createObjectURL(file);
        preview.onload = () => URL.revokeObjectURL(url);
        preview.src = url;
        wrapper.classList.remove('hidden');
        name.textContent = file.name;
    });
});
</script>
