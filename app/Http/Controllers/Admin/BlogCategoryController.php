<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount('blogs')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('admin.blogs.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $base = Str::slug($data['name']) ?: 'category';
        $slug = $base;
        $i = 2;

        while (BlogCategory::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        BlogCategory::create([...$data, 'slug' => $slug]);

        return back()->with('success', 'Category created successfully.');
    }

    public function update(Request $request, BlogCategory $blogCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $blogCategory->update($data);

        return back()->with('success', 'Category updated successfully.');
    }

    public function destroy(BlogCategory $blogCategory)
    {
        if ($blogCategory->blogs()->exists()) {
            return back()->withErrors([
                'category' => 'Delete category blogs first.'
            ]);
        }

        $blogCategory->delete();

        return back()->with('success', 'Category deleted.');
    }
}
