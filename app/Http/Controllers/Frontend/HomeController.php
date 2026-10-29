<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\GalleryImage;
use App\Models\AcademyCourse;
use App\Models\Blog;
use App\Models\Branch;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    public function index()
    {
        $servicesQuery = Service::query();

        if (Schema::hasColumn('services', 'is_active')) {
            $servicesQuery->where('is_active', true);
        }

        if (Schema::hasColumn('services', 'is_featured')) {
            $servicesQuery->orderByDesc('is_featured');
        }

        $services = $servicesQuery->latest('id')->get();

        $galleryQuery = GalleryImage::query();

        if (Schema::hasColumn('gallery_images', 'is_active')) {
            $galleryQuery->where('is_active', true);
        }

        $galleryImages = $galleryQuery->latest('id')->limit(12)->get();

        $coursesQuery = AcademyCourse::query();

        if (Schema::hasColumn('academy_courses', 'is_active')) {
            $coursesQuery->where('is_active', true);
        }

        if (Schema::hasColumn('academy_courses', 'is_featured')) {
            $coursesQuery->orderByDesc('is_featured');
        }

        $courses = $coursesQuery->latest('id')->limit(3)->get();

        $blogs = Blog::query()
            ->where('is_published', true)
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            })
            ->latest('id')
            ->limit(3)
            ->get();

        $branchesQuery = Branch::query();

        if (Schema::hasColumn('branches', 'is_active')) {
            $branchesQuery->where('is_active', true);
        } elseif (Schema::hasColumn('branches', 'status')) {
            $branchesQuery->where('status', 'active');
        }

        $branches = $branchesQuery->latest('id')->limit(3)->get();

        return view('frontend.home.index', compact(
            'services',
            'galleryImages',
            'courses',
            'blogs',
            'branches'
        ));
    }
}
