<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::orderByDesc('is_primary')
            ->orderBy('sort_order')
            ->paginate(12);

        return view('admin.branches.index', compact('branches'));
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);

        $base = Str::slug($data['name']) ?: 'branch';
        $slug = $base;
        $i = 2;

        while (Branch::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('branches', 'public');
        }

        try {
            DB::transaction(function () use ($data) {
                if ($data['is_primary']) {
                    Branch::where('is_primary', true)
                        ->update(['is_primary' => false]);
                }

                Branch::create($data);
            });
        } catch (\Throwable $e) {
            if (!empty($data['image'])) {
                Storage::disk('public')->delete($data['image']);
            }

            throw $e;
        }

        return redirect()
            ->route('admin.branches.index')
            ->with('success', 'Branch created successfully.');
    }

    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {
        $data = $this->validatedData($request);

        $oldImage = $branch->image;
        $newImage = null;

        if ($request->hasFile('image')) {
            $newImage = $request->file('image')
                ->store('branches', 'public');

            $data['image'] = $newImage;
        }

        try {
            DB::transaction(function () use ($data, $branch) {
                if ($data['is_primary']) {
                    Branch::where('id', '!=', $branch->id)
                        ->update(['is_primary' => false]);
                }

                $branch->update($data);
            });
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
            ->route('admin.branches.index')
            ->with('success', 'Branch updated successfully.');
    }

    public function destroy(Branch $branch)
    {
        $image = $branch->image;

        $branch->delete();

        if ($image) {
            Storage::disk('public')->delete($image);
        }

        return redirect()
            ->route('admin.branches.index')
            ->with('success', 'Branch deleted successfully.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'state' => ['nullable', 'string', 'max:255'],
            'pincode' => ['nullable', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:2000'],

            'phone' => ['required', 'string', 'max:20'],
            'alternate_phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],

            'google_maps_url' => [
                'nullable', 'url', 'max:2000', 'regex:/^https:\/\//i'
            ],

            'opening_time' => ['nullable', 'date_format:H:i'],
            'closing_time' => [
                'nullable', 'date_format:H:i',
                'after:opening_time'
            ],
            'working_days' => ['nullable', 'string', 'max:255'],

            'image' => [
                'nullable', 'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048'
            ],

            'is_active' => ['required', 'boolean'],
            'is_primary' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0'],
        ]);
    }
}
