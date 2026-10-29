@php
    $service = $service ?? null;
    $input = 'w-full min-w-0 rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm focus:border-brand focus:outline-none';
@endphp

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">

    <div>
        <label for="name" class="mb-2 block text-sm font-semibold">
            Service Name *
        </label>

        <input id="name" name="name" type="text" required maxlength="255" value="{{ old('name', $service?->name) }}"
            placeholder="Example: Hair Spa" class="{{ $input }}">

        @error('name')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="service_category_id" class="mb-2 block text-sm font-semibold">
            Category *
        </label>

        <select id="service_category_id" name="service_category_id" required class="{{ $input }}">
            <option value="">Select Category</option>

            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('service_category_id', $service?->service_category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        @error('service_category_id')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="md:col-span-2">
        <label for="short_description" class="mb-2 block text-sm font-semibold">
            Short Description
        </label>

        <textarea id="short_description" name="short_description" maxlength="500" rows="2"
            class="{{ $input }}">{{ old('short_description', $service?->short_description) }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label for="description" class="mb-2 block text-sm font-semibold">
            Full Description
        </label>

        <textarea id="description" name="description" rows="5"
            class="{{ $input }}">{{ old('description', $service?->description) }}</textarea>
    </div>

    <div>
        <label for="price" class="mb-2 block text-sm font-semibold">
            Price (₹)
        </label>

        <input id="price" name="price" type="number" min="0" step="0.01" value="{{ old('price', $service?->price) }}"
            class="{{ $input }}">
    </div>

    <div>
        <label for="duration_minutes" class="mb-2 block text-sm font-semibold">
            Duration (Minutes)
        </label>

        <input id="duration_minutes" name="duration_minutes" type="number" min="1"
            value="{{ old('duration_minutes', $service?->duration_minutes) }}" class="{{ $input }}">
    </div>

    <!-- <div class="md:col-span-2">
        <label for="image" class="mb-2 block text-sm font-semibold">
            Service Image
        </label>

        @if($service?->image)
            <img src="{{ asset('storage/' . $service->image) }}"
                 alt="{{ $service->name }}"
                 class="mb-3 h-32 w-40 rounded-xl object-cover">
        @endif

        
               accept=".jpg,.jpeg,.png,.webp"
               class="block w-full min-w-0 text-sm<input id="image" name="image" type="file" text-slate-600">

        <p class="mt-1 text-xs text-slate-500">
            JPG, PNG or WebP. Maximum 2 MB.
        </p>

        @error('image')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div> -->


    <!-- SERVICE IMAGE UPLOAD -->
    <div class="md:col-span-2">

        <label for="image" class="mb-2 block text-sm font-semibold text-slate-800">
            Service Image
        </label>

        <div class="rounded-2xl border-2 border-dashed
                border-slate-300 bg-slate-50 p-5
                text-center sm:p-8">

            <!-- Image Preview -->
            <div id="imagePreviewWrapper" class="mb-4 {{ !empty($service?->image) ? '' : 'hidden' }}">

                <img id="imagePreview" src="{{ !empty($service?->image)
    ? asset('storage/' . $service->image)
    : '' }}" alt="Service image preview" class="mx-auto h-40 w-full max-w-xs
                        rounded-xl object-cover">
            </div>

            <div class="mb-3 text-3xl">📷</div>

            <p class="mb-3 text-sm font-semibold text-slate-800">
                Upload Service Image
            </p>

            <label for="image" class="inline-flex min-h-11 cursor-pointer
                      items-center justify-center rounded-xl
                      bg-brand px-6 py-3 text-sm
                      font-semibold text-white
                      transition hover:bg-brand-dark">

                Choose Image

            </label>

            <input id="image" name="image" type="file" accept=".jpg,.jpeg,.png,.webp" class="sr-only"
                onchange="previewServiceImage(this)">

            <p id="selectedImageName" class="mt-3 break-all text-xs text-slate-500">
                No new image selected
            </p>

            <p class="mt-2 text-xs text-slate-400">
                Supported: JPG, JPEG, PNG, WebP — Max 2 MB
            </p>

            @error('image')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>

    </div>

    @once
        <script>
            function previewServiceImage(input) {
                const file = input.files && input.files[0];
                const preview = document.getElementById('imagePreview');
                const wrapper = document.getElementById('imagePreviewWrapper');
                const fileName = document.getElementById('selectedImageName');

                if (!file) {
                    fileName.textContent = 'No new image selected';
                    return;
                }

                const allowedTypes = [
                    'image/jpeg',
                    'image/png',
                    'image/webp'
                ];

                if (!allowedTypes.includes(file.type) ||
                    file.size > 2 * 1024 * 1024) {

                    alert('Please select a JPG, PNG or WebP image under 2 MB.');
                    input.value = '';
                    fileName.textContent = 'No new image selected';
                    return;
                }

                const reader = new FileReader();

                reader.onload = function (event) {
                    preview.src = event.target.result;
                    wrapper.classList.remove('hidden');
                };

                reader.readAsDataURL(file);
                fileName.textContent = file.name;
            }
        </script>
    @endonce


    <div>
        <label for="sort_order" class="mb-2 block text-sm font-semibold">
            Sort Order
        </label>

        <input id="sort_order" name="sort_order" type="number" min="0" required
            value="{{ old('sort_order', $service?->sort_order ?? 0) }}" class="{{ $input }}">
    </div>

    <div>
        <label for="is_active" class="mb-2 block text-sm font-semibold">
            Status
        </label>

        <select id="is_active" name="is_active" class="{{ $input }}">
            <option value="1" @selected((string) old('is_active', $service?->is_active ?? 1) === '1')>
                Active
            </option>
            <option value="0" @selected((string) old('is_active', $service?->is_active ?? 1) === '0')>
                Inactive
            </option>
        </select>
    </div>

    <div>
        <label for="is_featured" class="mb-2 block text-sm font-semibold">
            Featured Service
        </label>

        <select id="is_featured" name="is_featured" class="{{ $input }}">
            <option value="0" @selected((string) old('is_featured', $service?->is_featured ?? 0) === '0')>
                No
            </option>
            <option value="1" @selected((string) old('is_featured', $service?->is_featured ?? 0) === '1')>
                Yes
            </option>
        </select>
    </div>

    <div class="md:col-span-2 border-t border-slate-200 pt-5">
        <h3 class="mb-4 font-heading text-lg font-semibold">
            SEO Settings
        </h3>

        <div class="space-y-4">
            <div>
                <label for="meta_title" class="mb-2 block text-sm font-semibold">
                    Meta Title
                </label>

                <input id="meta_title" name="meta_title" maxlength="255"
                    value="{{ old('meta_title', $service?->meta_title) }}" class="{{ $input }}">
            </div>

            <div>
                <label for="meta_description" class="mb-2 block text-sm font-semibold">
                    Meta Description
                </label>

                <textarea id="meta_description" name="meta_description" maxlength="500" rows="3"
                    class="{{ $input }}">{{ old('meta_description', $service?->meta_description) }}</textarea>
            </div>
        </div>
    </div>

</div>

<div class="mt-7 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

    <a href="{{ route('admin.services.index') }}" class="inline-flex min-h-11 items-center justify-center
              rounded-xl border border-slate-300 px-6 py-3
              text-sm font-semibold text-slate-700">
        Cancel
    </a>

    <button type="submit" class="min-h-11 rounded-xl bg-brand px-6 py-3
                   text-sm font-semibold text-white
                   transition hover:bg-brand-dark">
        Save Service
    </button>

</div>