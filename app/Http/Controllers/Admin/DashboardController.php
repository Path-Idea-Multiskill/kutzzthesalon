<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Blog;
use App\Models\Appointment;
use App\Models\Enquiry;
use App\Models\AcademyCourse;
use App\Models\GalleryImage;
use App\Models\Branch;
use App\Models\Page;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'services' => Service::count(),
            'blogs' => Blog::count(),
            'appointments' => Appointment::count(),
            'enquiries' => Enquiry::where('status', 'new')->count(),

            'courses' => AcademyCourse::count(),
            'gallery' => GalleryImage::count(),
            'branches' => Branch::count(),
            'pages' => Page::count(),

            'today_appointments' => Appointment::whereDate(
                'appointment_at',
                today()
            )->count(),

            'pending_appointments' => Appointment::where(
                'status',
                'pending'
            )->count(),

            'published_blogs' => Blog::where(
                'is_published',
                true
            )->count(),
        ];

        $recentAppointments = Appointment::with('service')
            ->latest('created_at')
            ->limit(5)
            ->get();

        $recentEnquiries = Enquiry::latest('created_at')
            ->limit(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'stats',
            'recentAppointments',
            'recentEnquiries'
        ));
    }
}