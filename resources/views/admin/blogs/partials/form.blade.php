
@php
    $blog = $blog ?? null;
    $input = 'min-h-11 w-full min-w-0 rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-brand focus:ring-2 focus:ring-red-100';
@endphp

<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label for="title" class="mb-2 block text-sm font-semibold">Blog Title *</label>
        <input id="title" name="title" required maxlength="255"
               value="{{ old('title', $blog?->title) }}"
               placeholder="Top 5 Hair Care Tips for Healthy Hair"
               class="{{ $input }}">
    </div>

    <div>
        <label for="blog_category_id" class="mb-2 block text-sm font-semibold">Category *</label>
        <select id="blog_category_id" name="blog_category_id" required class="{{ $input }}">
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('blog_category_id', $blog?->blog_category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label for="author_name" class="mb-2 block text-sm font-semibold">Author Name</label>
        <input id="author_name" name="author_name" maxlength="255"
               value="{{ old('author_name', $blog?->author_name) }}"
               placeholder="Kutzz Salon Team" class="{{ $input }}">
    </div>

    <div class="md:col-span-2">
        <label for="excerpt" class="mb-2 block text-sm font-semibold">Short Excerpt</label>
        <textarea id="excerpt" name="excerpt" rows="3" maxlength="1000"
                  class="{{ $input }}">{{ old('excerpt', $blog?->excerpt) }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label for="content" class="mb-2 block text-sm font-semibold">Blog Content *</label>
        <textarea id="content" name="content" rows="12" required
                  placeholder="Write your article here..."
                  class="{{ $input }}">{{ old('content', $blog?->content) }}</textarea>
    </div>

    <div class="md:col-span-2">
        <label for="blogImage" class="mb-2 block text-sm font-semibold">Featured Image</label>
        <div class="rounded-2xl border-2 border-dashed border-slate-200 bg-slate-50 p-6 text-center">
            <div id="blogImagePreviewWrapper" class="{{ $blog?->featured_image ? '' : 'hidden' }} mb-4">
                <img id="blogImagePreview"
                     src="{{ $blog?->featured_image ? asset('storage/' . $blog->featured_image) : '' }}"
                     alt="Featured image preview"
                     class="mx-auto aspect-video w-full max-w-sm rounded-xl object-cover">
            </div>

            <p class="mb-3 text-3xl">📷</p>
            <label for="blogImage"
                   class="inline-flex min-h-11 cursor-pointer items-center rounded-xl bg-brand px-6 text-sm font-semibold text-white">
                Choose Featured Image
            </label>

            <input id="blogImage" name="featured_image" type="file"
                   accept=".jpg,.jpeg,.png,.webp" class="sr-only">

            <p id="blogImageName" class="mt-3 text-xs text-slate-500">
                JPG, PNG, WebP — Max 2 MB
            </p>
        </div>
    </div>

    <div>
        <label for="is_published" class="mb-2 block text-sm font-semibold">Publish Status</label>
        <select id="is_published" name="is_published" class="{{ $input }}">
            <option value="0" @selected((string) old('is_published', (int) ($blog?->is_published ?? false)) === '0')>Draft</option>
            <option value="1" @selected((string) old('is_published', (int) ($blog?->is_published ?? false)) === '1')>Published</option>
        </select>
    </div>

    <div>
        <label for="is_featured" class="mb-2 block text-sm font-semibold">Featured Blog</label>
        <select id="is_featured" name="is_featured" class="{{ $input }}">
            <option value="0" @selected((string) old('is_featured', (int) ($blog?->is_featured ?? false)) === '0')>No</option>
            <option value="1" @selected((string) old('is_featured', (int) ($blog?->is_featured ?? false)) === '1')>Yes</option>
        </select>
    </div>

    <div class="md:col-span-2 border-t border-slate-100 pt-5">
        <h3 class="mb-4 font-heading text-lg font-bold">SEO Settings</h3>

        <div class="space-y-4">
            <div>
                <label for="meta_title" class="mb-2 block text-sm font-semibold">Meta Title</label>
                <input id="meta_title" name="meta_title" maxlength="255"
                       value="{{ old('meta_title', $blog?->meta_title) }}"
                       class="{{ $input }}">
            </div>

            <div>
                <label for="meta_description" class="mb-2 block text-sm font-semibold">Meta Description</label>
                <textarea id="meta_description" name="meta_description"
                          maxlength="500" rows="3"
                          class="{{ $input }}">{{ old('meta_description', $blog?->meta_description) }}</textarea>
            </div>
        </div>
    </div>
</div>

<div class="mt-7 flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
    <a href="{{ route('admin.blogs.index') }}"
       class="inline-flex min-h-11 items-center justify-center rounded-xl border border-slate-200 px-6 text-sm font-semibold">
        Cancel
    </a>
    <button type="submit"
            class="min-h-11 rounded-xl bg-brand px-6 text-sm font-semibold text-white">
        Save Blog
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('blogImage');
    const preview = document.getElementById('blogImagePreview');
    const wrapper = document.getElementById('blogImagePreviewWrapper');
    const name = document.getElementById('blogImageName');

    input.addEventListener('change', function () {
        const file = this.files && this.files[0];
        if (!file) return;

        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type)
            || file.size > 2 * 1024 * 1024) {
            alert('Please select JPG, PNG or WebP under 2 MB.');
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
