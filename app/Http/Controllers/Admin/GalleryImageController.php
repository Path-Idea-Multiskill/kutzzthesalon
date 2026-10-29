<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class GalleryImageController extends Controller
{
    public function index()
    {
        $images = GalleryImage::with('category')
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(18);

        $categories = GalleryCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('admin.gallery.index', compact('images', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gallery_category_id' => [
                'required',
                Rule::exists('gallery_categories', 'id')
                    ->where('is_active', true),
            ],
            'title' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
            'images' => ['required', 'array', 'min:1', 'max:10'],
            'images.*' => [
                'required', 'image', 'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],
        ]);

        foreach ($request->file('images') as $file) {
            $path = $file->store('gallery', 'public');

            GalleryImage::create([
                'gallery_category_id' => $data['gallery_category_id'],
                'title' => $data['title'] ?? null,
                'alt_text' => $data['alt_text'] ?? null,
                'sort_order' => $data['sort_order'],
                'is_active' => $data['is_active'],
                'image' => $path,
            ]);
        }

        return back()->with('success', 'Gallery images uploaded.');
    }

    public function update(Request $request, GalleryImage $galleryImage)
    {
        $data = $request->validate([
            'gallery_category_id' => [
                'required',
                Rule::exists('gallery_categories', 'id'),
            ],
            'title' => ['nullable', 'string', 'max:255'],
            'alt_text' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'is_active' => ['required', 'boolean'],
        ]);

        $galleryImage->update($data);

        return back()->with('success', 'Image updated.');
    }

    public function destroy(GalleryImage $galleryImage)
    {
        $path = $galleryImage->image;

        $galleryImage->delete();

        Storage::disk('public')->delete($path);

        return back()->with('success', 'Image deleted.');
    }
}
