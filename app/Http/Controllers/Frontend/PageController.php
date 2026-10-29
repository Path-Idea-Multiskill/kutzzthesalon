<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AcademyCourse;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Branch;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class PageController extends Controller
{
    private function publishedBlogs()
    {
        return Blog::with('category')
            ->where('is_published', true)
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    public function about()
    {
        $branches = Branch::where('is_active', true)->get();

        $galleryImages = GalleryImage::latest('id')
            ->limit(6)
            ->get();

        return view('frontend.about.index', compact(
            'branches',
            'galleryImages'
        ));
    }

    public function services(Request $request)
    {
        $categories = ServiceCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $services = Service::with('category')
            ->where('is_active', true)
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($categoryQuery) use ($request) {
                    $categoryQuery->where('slug', $request->query('category'));
                });
            })
            ->orderBy('sort_order')
            ->paginate(12)
            ->withQueryString();

        return view('frontend.services.index', compact(
            'categories',
            'services'
        ));
    }

    public function serviceShow(string $slug)
    {
        $service = Service::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $relatedServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->where('service_category_id', $service->service_category_id)
            ->limit(3)
            ->get();

        return view('frontend.services.show', compact(
            'service',
            'relatedServices'
        ));
    }

    public function gallery(Request $request)
    {
        $categories = GalleryCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $images = GalleryImage::with('category')
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($categoryQuery) use ($request) {
                    $categoryQuery->where('slug', $request->query('category'));
                });
            })
            ->latest('id')
            ->paginate(18)
            ->withQueryString();

        return view('frontend.gallery.index', compact(
            'categories',
            'images'
        ));
    }

    public function academy()
    {
        $courses = AcademyCourse::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('frontend.academy.index', compact('courses'));
    }

    public function blogs(Request $request)
    {
        $categories = BlogCategory::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        $blogs = $this->publishedBlogs()
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($categoryQuery) use ($request) {
                    $categoryQuery->where('slug', $request->query('category'));
                });
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('frontend.blogs.index', compact(
            'categories',
            'blogs'
        ));
    }

    public function blogShow(string $slug)
    {
        $blog = $this->publishedBlogs()
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedBlogs = $this->publishedBlogs()
            ->where('id', '!=', $blog->id)
            ->where('blog_category_id', $blog->blog_category_id)
            ->latest('published_at')
            ->limit(4)
            ->get();

        return view('frontend.blogs.show', compact(
            'blog',
            'relatedBlogs'
        ));
    }

    public function contact()
    {
        $branches = Branch::where('is_active', true)
            ->orderByDesc('is_primary')
            ->get();

        return view('frontend.contact.index', compact('branches'));
    }


    public function submitContact(Request $request)
    {
        // Honeypot field: ordinary visitors leave it empty.
        if ($request->filled('website')) {
            return back()->with('success', 'Thank you for contacting us.');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'type' => ['required', 'in:general,service,academy,bridal,other'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        \App\Models\Enquiry::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'type' => $data['type'],
            'subject' => 'Website Contact Enquiry',
            'message' => $data['message'],
            'status' => 'new',
            'source' => 'website',
        ]);

        return redirect()
            ->route('contact')
            ->with('success', 'Thank you! Your enquiry has been submitted successfully.');
    }

}
