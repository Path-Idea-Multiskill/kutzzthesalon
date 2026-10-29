<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->latest('id')
            ->paginate(12);

        return view('frontend.services.index', compact('services'));
    }

    public function show(string $slug)
    {
        $service = Service::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedServices = Service::query()
            ->where('is_active', true)
            ->where('id', '!=', $service->id)
            ->where('service_category_id', $service->service_category_id)
            ->orderBy('sort_order')
            ->limit(3)
            ->get();

        return view('frontend.services.show', compact(
            'service',
            'relatedServices'
        ));
    }
}
