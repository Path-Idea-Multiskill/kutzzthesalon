<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryCategoryController extends Controller
{
    public function index()
    {
        $categories = GalleryCategory::withCount('images')
            ->orderBy('sort_order')
            ->paginate(15);

        return view('admin.gallery.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $base = Str::slug($data['name']);

        if ($base === '') {
            return back()->withErrors([
                'name' => 'Enter a valid category name.'
            ])->withInput();
        }

        $slug = $base;
        $i = 2;

        while (GalleryCategory::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        GalleryCategory::create([
            ...$data,
            'slug' => $slug,
        ]);

        return back()->with('success', 'Category created.');
    }

    public function update(Request $request, GalleryCategory $galleryCategory)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $galleryCategory->update($data);

        return redirect()
            ->route('admin.gallery-categories.index')
            ->with('success', 'Category updated.');
    }

    public function destroy(GalleryCategory $galleryCategory)
    {
        if ($galleryCategory->images()->exists()) {
            return back()->withErrors([
                'category' => 'Delete gallery images first.'
            ]);
        }

        $galleryCategory->delete();

        return back()->with('success', 'Category deleted.');
    }
}
