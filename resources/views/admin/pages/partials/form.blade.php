
@php
    $page = $page ?? null;

    $inputClass = 'w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-800 outline-none focus:border-brand focus:ring-2 focus:ring-red-100';
@endphp

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

    <div class="space-y-6 lg:col-span-2">

        <div>
            <label class="mb-2 block text-sm font-semibold">
                Page Title *
            </label>

            <input type="text"
                   name="title"
                   required
                   maxlength="255"
                   value="{{ old('title', $page?->title) }}"
                   placeholder="Example: About Us"
                   class="{{ $inputClass }}">
        </div>

        <div>
            <label class="mb-2 block text-sm font-semibold">
                Page Content
            </label>

            <textarea name="content"
                      rows="15"
                      placeholder="Write your page content..."
                      class="{{ $inputClass }}">{{ old('content', $page?->content) }}</textarea>

            <p class="mt-2 text-xs text-slate-500">
                Plain text content. Rich text editor can be added later.
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 p-5">
            <h3 class="mb-4 font-bold text-slate-900">
                SEO Settings
            </h3>

            <div class="space-y-4">
                <div>
                    <label class="mb-2 block text-sm font-semibold">
                        Meta Title
                    </label>

                    <input type="text"
                           name="meta_title"
                           maxlength="255"
                           value="{{ old('meta_title', $page?->meta_title) }}"
                           class="{{ $inputClass }}">
                </div>

                <div>
                    <label class="mb-2 block text-sm font-semibold">
                        Meta Description
                    </label>

                    <textarea name="meta_description"
                              rows="4"
                              maxlength="500"
                              class="{{ $inputClass }}">{{ old('meta_description', $page?->meta_description) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="space-y-5 rounded-2xl border border-slate-200 bg-slate-50 p-5">

            <h3 class="font-bold text-slate-900">
                Publishing Settings
            </h3>

            <div>
                <label class="mb-2 block text-sm font-semibold">
                    Page Status
                </label>

                <select name="is_published" class="{{ $inputClass }}">
                    <option value="1" @selected(old('is_published', $page?->is_published ?? false) == 1)>
                        Published
                    </option>
                    <option value="0" @selected(old('is_published', $page?->is_published ?? false) == 0)>
                        Draft
                    </option>
                </select>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold">
                    Show in Footer
                </label>

                <select name="show_in_footer" class="{{ $inputClass }}">
                    <option value="1" @selected(old('show_in_footer', $page?->show_in_footer ?? false) == 1)>
                        Yes
                    </option>
                    <option value="0" @selected(old('show_in_footer', $page?->show_in_footer ?? false) == 0)>
                        No
                    </option>
                </select>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold">
                    Sort Order
                </label>

                <input type="number"
                       name="sort_order"
                       min="0"
                       value="{{ old('sort_order', $page?->sort_order ?? 0) }}"
                       class="{{ $inputClass }}">
            </div>

            @if($page)
                <div class="rounded-xl bg-white p-3">
                    <p class="text-xs text-slate-500">Page Slug</p>
                    <p class="mt-1 break-all text-sm font-medium">
                        {{ $page->slug }}
                    </p>
                </div>
            @endif

            <button type="submit"
                    class="w-full rounded-xl bg-brand px-5 py-3 font-semibold text-white hover:bg-brand-dark">
                {{ $page ? 'Update Page' : 'Publish / Save Page' }}
            </button>

            <a href="{{ route('admin.pages.index') }}"
               class="block rounded-xl border border-slate-200 bg-white px-5 py-3 text-center text-sm font-semibold">
                Cancel
            </a>
        </div>
    </div>
</div>
