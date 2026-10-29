<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class WebsiteSettingController extends Controller
{
    public function index()
    {
        $settings = WebsiteSetting::firstOrCreate(
            ['id' => 1],
            ['site_name' => 'Kutz The Salon']
        );

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'site_tagline' => ['nullable', 'string', 'max:255'],

            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'address' => ['nullable', 'string', 'max:2000'],

            'primary_color' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'secondary_color' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],
            'light_color' => ['required', 'regex:/^#[0-9a-fA-F]{6}$/'],

            'heading_font' => [
                'required',
                Rule::in(['Poppins', 'Inter']),
            ],

            'body_font' => [
                'required',
                Rule::in(['Inter', 'Poppins']),
            ],
        ]);

        $settings = WebsiteSetting::firstOrCreate(
            ['id' => 1],
            ['site_name' => 'Kutz The Salon']
        );

        $settings->update($validated);

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Website settings updated successfully.');
    }
}
