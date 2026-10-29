<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademyCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AcademyCourseController extends Controller
{
    public function index()
    {
        $courses = AcademyCourse::orderBy('sort_order')
            ->latest('id')
            ->paginate(12);

        return view('admin.academy.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.academy.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        $base = Str::slug($data['title']) ?: 'course';
        $slug = $base;
        $number = 2;

        while (AcademyCourse::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $number++;
        }

        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('academy', 'public');
        }

        try {
            AcademyCourse::create($data);
        } catch (\Throwable $e) {
            if (!empty($data['image'])) {
                Storage::disk('public')->delete($data['image']);
            }

            throw $e;
        }

        return redirect()
            ->route('admin.academy-courses.index')
            ->with('success', 'Course created successfully.');
    }

    public function edit(AcademyCourse $academyCourse)
    {
        return view('admin.academy.edit', [
            'course' => $academyCourse,
        ]);
    }

    public function update(Request $request, AcademyCourse $academyCourse)
    {
        $data = $this->validatedData($request);

        $oldImage = $academyCourse->image;
        $newImage = null;

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('academy', 'public');

            $data['image'] = $newImage;
        }

        try {
            $academyCourse->update($data);
        } catch (\Throwable $e) {
            if ($newImage) {
                Storage::disk('public')->delete($newImage);
            }

            throw $e;
        }

        if ($newImage && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()
            ->route('admin.academy-courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(AcademyCourse $academyCourse)
    {
        $image = $academyCourse->image;

        $academyCourse->delete();

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('admin.academy-courses.index')
            ->with('success', 'Course deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string', 'max:30000'],
            'curriculum' => ['nullable', 'string', 'max:30000'],
            'fees' => ['nullable', 'numeric', 'min:0', 'max:99999999.99'],
            'duration' => ['nullable', 'string', 'max:100'],
            'eligibility' => ['nullable', 'string', 'max:255'],
            'certificate' => ['nullable', 'string', 'max:255'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
            'is_active' => ['required', 'boolean'],
            'is_featured' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
        ]);
    }
}
