<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')
            ->latest('id')
            ->paginate(12);

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::where('is_active', true)
            ->orderBy('sort_order')->get();

        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        $base = Str::slug($data['title']) ?: 'blog';
        $slug = $base;
        $i = 2;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        $data['slug'] = $slug;
        $data['published_at'] = $data['is_published'] ? now() : null;

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')
                ->store('blogs', 'public');
        }

        try {
            Blog::create($data);
        } catch (\Throwable $e) {
            if (!empty($data['featured_image'])) {
                Storage::disk('public')->delete($data['featured_image']);
            }
            throw $e;
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::orderBy('sort_order')->get();

        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $this->validatedData($request);

        $data['published_at'] = $data['is_published']
            ? ($blog->published_at ?? now())
            : null;

        $oldImage = $blog->featured_image;
        $newImage = null;

        if ($request->hasFile('featured_image')) {
            $newImage = $request->file('featured_image')
                ->store('blogs', 'public');

            $data['featured_image'] = $newImage;
        }

        try {
            $blog->update($data);
        } catch (\Throwable $e) {
            if ($newImage) {
                Storage::disk('public')->delete($newImage);
            }
            throw $e;
        }

        if ($newImage && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        $image = $blog->featured_image;

        $blog->delete();

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return back()->with('success', 'Blog deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'blog_category_id' => ['required', Rule::exists('blog_categories', 'id')],
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['required', 'string', 'max:100000'],
            'featured_image' => [
                'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'
            ],
            'author_name' => ['nullable', 'string', 'max:255'],
            'is_published' => ['required', 'boolean'],
            'is_featured' => ['required', 'boolean'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);
    }
}
