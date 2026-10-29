<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(10);

        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $categories = ServiceCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['slug'] = $this->uniqueSlug($data['name']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('services', 'public');
        }

        Service::create($data);

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view(
            'admin.services.edit',
            compact('service', 'categories')
        );
    }

    public function update(Request $request, Service $service)
    {
        $data = $this->validateData($request);

        // Keep slug stable so existing URLs do not break.
        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('services', 'public');

            $data['image'] = $newImage;

            $oldImage = $service->image;
        }

        $service->update($data);

        if (isset($newImage) && !empty($oldImage)) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $image = $service->image;

        $service->delete();

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service deleted successfully.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'service_category_id' => [
                'required',
                'integer',
                Rule::exists('service_categories', 'id'),
            ],

            'name' => ['required', 'string', 'max:255'],

            'short_description' => [
                'nullable', 'string', 'max:500'
            ],

            'description' => ['nullable', 'string', 'max:20000'],

            'price' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],

            'duration_minutes' => [
                'nullable', 'integer', 'min:1', 'max:1440'
            ],

            'image' => [
                'nullable', 'image', 'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'is_active' => ['required', 'boolean'],
            'is_featured' => ['required', 'boolean'],

            'sort_order' => ['required', 'integer', 'min:0'],

            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => [
                'nullable', 'string', 'max:500'
            ],
        ]);
    }

    private function uniqueSlug(string $name): string
    {
        $base = Str::slug($name);

        if ($base === '') {
            $base = 'service';
        }

        $slug = $base;
        $number = 2;

        while (Service::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $number++;
        }

        return $slug;
    }
}
