
@php
    $category = $serviceCategory ?? null;
@endphp

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">

    <div class="md:col-span-2">
        <label for="name"
               class="mb-2 block text-sm font-semibold">
            Category Name *
        </label>

        <input
            id="name"
            type="text"
            name="name"
            required
            maxlength="255"
            value="{{ old('name', $category?->name) }}"
            placeholder="Example: Hair Services"
            class="w-full min-w-0 rounded-xl border
                   border-slate-300 px-4 py-3
                   focus:border-brand focus:outline-none">

        @error('name')
            <p class="mt-1 text-xs text-red-600">
                {{ $message }}
            </p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="description"
               class="mb-2 block text-sm font-semibold">
            Description
        </label>

        <textarea
            id="description"
            name="description"
            rows="4"
            placeholder="Write category description..."
            class="w-full min-w-0 rounded-xl border
                   border-slate-300 px-4 py-3
                   focus:border-brand focus:outline-none">{{ old('description', $category?->description) }}</textarea>
    </div>

    <div>
        <label for="sort_order"
               class="mb-2 block text-sm font-semibold">
            Sort Order
        </label>

        <input
            id="sort_order"
            type="number"
            name="sort_order"
            min="0"
            required
            value="{{ old('sort_order', $category?->sort_order ?? 0) }}"
            class="w-full min-w-0 rounded-xl border
                   border-slate-300 px-4 py-3
                   focus:border-brand focus:outline-none">
    </div>

    <div>
        <label for="is_active"
               class="mb-2 block text-sm font-semibold">
            Status
        </label>

        <select
            id="is_active"
            name="is_active"
            class="w-full min-w-0 rounded-xl border
                   border-slate-300 bg-white px-4 py-3">

            <option value="1"
                @selected((string) old('is_active', $category?->is_active ?? 1) === '1')>
                Active
            </option>

            <option value="0"
                @selected((string) old('is_active', $category?->is_active ?? 1) === '0')>
                Inactive
            </option>

        </select>
    </div>

</div>

<div class="mt-7 flex flex-col-reverse gap-3
            sm:flex-row sm:justify-end">

    <a href="{{ route('admin.service-categories.index') }}"
       class="inline-flex min-h-11 items-center justify-center
              rounded-xl border border-slate-300 px-6 py-3
              text-sm font-semibold text-slate-600">
        Cancel
    </a>

    <button type="submit"
            class="min-h-11 rounded-xl bg-brand px-6 py-3
                   text-sm font-semibold text-white
                   hover:bg-brand-dark">
        Save Category
    </button>

</div>
