@php
    $course = $course ?? null;

    $input = 'min-h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none transition focus:border-brand focus:ring-2 focus:ring-red-100';
@endphp

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">

    <div>
        <label for="title" class="mb-2 block text-sm font-semibold">
            Course Title *
        </label>
        <input id="title" name="title" required maxlength="255"
               value="{{ old('title', $course?->title) }}"
               placeholder="Professional Hair Styling Course"
               class="{{ $input }}">
        @error('title')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="subtitle" class="mb-2 block text-sm font-semibold">
            Subtitle
        </label>
        <input id="subtitle" name="subtitle" maxlength="255"
               value="{{ old('subtitle', $course?->subtitle) }}"
               placeholder="Learn professional salon techniques"
               class="{{ $input }}">
    </div>

    <div class="md:col-span-2">
        <label for="short_description" class="mb-2 block text-sm font-semibold">
            Short Description
        </label>
        <textarea id="short_description" name="short_description"
                  rows="3" maxlength="1000"
                  class="{{ $input }}">{{ old('short_description', $course?->short_description) }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label for="description" class="mb-2 block text-sm font-semibold">
            Full Description
        </label>
        <textarea id="description" name="description" rows="5"
                  class="{{ $input }}">{{ old('description', $course?->description) }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label for="curriculum" class="mb-2 block text-sm font-semibold">
            Course Curriculum / Syllabus
        </label>
        <textarea id="curriculum" name="curriculum" rows="6"
                  placeholder="Module 1: Introduction..."
                  class="{{ $input }}">{{ old('curriculum', $course?->curriculum) }}</textarea>
    </div>

    <div>
        <label for="fees" class="mb-2 block text-sm font-semibold">
            Course Fees (₹)
        </label>
        <input id="fees" name="fees" type="number" min="0" step="0.01"
               value="{{ old('fees', $course?->fees) }}"
               class="{{ $input }}">
    </div>

    <div>
        <label for="duration" class="mb-2 block text-sm font-semibold">
            Duration
        </label>
        <input id="duration" name="duration" maxlength="100"
               value="{{ old('duration', $course?->duration) }}"
               placeholder="3 Months"
               class="{{ $input }}">
    </div>

    <div>
        <label for="eligibility" class="mb-2 block text-sm font-semibold">
            Eligibility
        </label>
        <input id="eligibility" name="eligibility" maxlength="255"
               value="{{ old('eligibility', $course?->eligibility) }}"
               placeholder="Beginners / Professionals"
               class="{{ $input }}">
    </div>

    <div>
        <label for="certificate" class="mb-2 block text-sm font-semibold">
            Certificate
        </label>
        <input id="certificate" name="certificate" maxlength="255"
               value="{{ old('certificate', $course?->certificate) }}"
               placeholder="Course Completion Certificate"
               class="{{ $input }}">
    </div>

    <div class="md:col-span-2">
        <label for="academyImage" class="mb-2 block text-sm font-semibold">
            Course Cover Image
        </label>

        <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-5 text-center sm:p-8">

            <div id="academyImagePreviewWrapper"
                 class="{{ $course?->image ? '' : 'hidden' }} mb-4">
                <img id="academyImagePreview"
                     src="{{ $course?->image ? asset('storage/' . $course->image) : '' }}"
                     alt="Course cover preview"
                     class="mx-auto aspect-video w-full max-w-sm rounded-xl object-cover">
            </div>

            <p class="mb-3 text-3xl">📷</p>
            <p class="mb-4 text-sm font-medium text-slate-600">
                JPG, PNG or WebP · Maximum 2 MB
            </p>

            <label for="academyImage"
                   class="inline-flex min-h-11 cursor-pointer items-center justify-center rounded-xl bg-brand px-6 py-3 text-sm font-semibold text-white">
                Choose Cover Image
            </label>

            <input id="academyImage" type="file" name="image"
                   accept=".jpg,.jpeg,.png,.webp"
                   class="sr-only">

            <p id="academyImageName" class="mt-3 break-all text-xs text-slate-500">
                No new image selected
            </p>
        </div>
        @error('image')
            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="sort_order" class="mb-2 block text-sm font-semibold">
            Sort Order
        </label>
        <input id="sort_order" name="sort_order" type="number" min="0" required
               value="{{ old('sort_order', $course?->sort_order ?? 0) }}"
               class="{{ $input }}">
    </div>

    <div>
        <label for="is_active" class="mb-2 block text-sm font-semibold">
            Status
        </label>
        <select id="is_active" name="is_active" class="{{ $input }}">
            <option value="1" @selected((string) old('is_active', (int) ($course?->is_active ?? true)) === '1')>Active</option>
            <option value="0" @selected((string) old('is_active', (int) ($course?->is_active ?? true)) === '0')>Inactive</option>
        </select>
    </div>

    <div>
        <label for="is_featured" class="mb-2 block text-sm font-semibold">
            Featured Course
        </label>
        <select id="is_featured" name="is_featured" class="{{ $input }}">
            <option value="0" @selected((string) old('is_featured', (int) ($course?->is_featured ?? false)) === '0')>No</option>
            <option value="1" @selected((string) old('is_featured', (int) ($course?->is_featured ?? false)) === '1')>Yes</option>
        </select>
    </div>

    <div class="md:col-span-2 border-t border-slate-100 pt-5">
        <h3 class="mb-5 font-heading text-lg font-bold">SEO Settings</h3>

        <div class="space-y-4">
            <div>
                <label for="meta_title" class="mb-2 block text-sm font-semibold">
                    Meta Title
                </label>
                <input id="meta_title" name="meta_title" maxlength="255"
                       value="{{ old('meta_title', $course?->meta_title) }}"
                       class="{{ $input }}">
            </div>

            <div>
                <label for="meta_description" class="mb-2 block text-sm font-semibold">
                    Meta Description
                </label>
                <textarea id="meta_description" name="meta_description"
                          maxlength="500" rows="3"
                          class="{{ $input }}">{{ old('meta_description', $course?->meta_description) }}</textarea>
            </div>
        </div>
    </div>
</div>

<div class="mt-7 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
    <a href="{{ route('admin.academy-courses.index') }}"
       class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-200 px-6 text-sm font-semibold">
        Cancel
    </a>

    <button type="submit"
            class="min-h-11 rounded-xl bg-brand px-6 text-sm font-semibold text-white hover:bg-brand-dark">
        Save Course
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('academyImage');
    const preview = document.getElementById('academyImagePreview');
    const wrapper = document.getElementById('academyImagePreviewWrapper');
    const name = document.getElementById('academyImageName');

    input.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) return;

        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)
            || file.size > 2 * 1024 * 1024) {
            alert('Select a JPG, PNG or WebP image under 2 MB.');
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
