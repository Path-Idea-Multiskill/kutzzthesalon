<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::query()
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(10);

        return view(
            'admin.services.categories.index',
            compact('categories')
        );
    }

    public function create()
    {
        return view('admin.services.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        $baseSlug = Str::slug($validated['name']);

        if ($baseSlug === '') {
            return back()
                ->withErrors(['name' => 'Enter a valid category name.'])
                ->withInput();
        }

        $slug = $baseSlug;
        $counter = 2;

        while (ServiceCategory::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter++;
        }

        ServiceCategory::create([
            ...$validated,
            'slug' => $slug,
        ]);

        return redirect()
            ->route('admin.service-categories.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        return view(
            'admin.services.categories.edit',
            compact('serviceCategory')
        );
    }

    public function update(
        Request $request,
        ServiceCategory $serviceCategory
    ) {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);

        // Preserve existing slug to avoid breaking frontend URLs.
        $serviceCategory->update($validated);

        return redirect()
            ->route('admin.service-categories.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();

        return redirect()
            ->route('admin.service-categories.index')
            ->with('success', 'Category deleted successfully.');
    }
}
