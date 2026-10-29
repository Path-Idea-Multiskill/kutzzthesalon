
<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\Frontend\PageController;

/*
|--------------------------------------------------------------------------
| Home Page
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| About Page
|--------------------------------------------------------------------------
*/

Route::get('/about', [PageController::class, 'about'])
    ->name('about');

/*
|--------------------------------------------------------------------------
| Services
|--------------------------------------------------------------------------
| Dedicated ServiceController
*/

Route::get('/services', [ServiceController::class, 'index'])
    ->name('services.index');

Route::get('/services/{slug}', [ServiceController::class, 'show'])
    ->name('services.show');

/*
|--------------------------------------------------------------------------
| Gallery
|--------------------------------------------------------------------------
*/

Route::get('/gallery', [PageController::class, 'gallery'])
    ->name('gallery.index');

/*
|--------------------------------------------------------------------------
| Academy
|--------------------------------------------------------------------------
*/

Route::get('/academy', [PageController::class, 'academy'])
    ->name('academy.index');

/*
|--------------------------------------------------------------------------
| Blogs
|--------------------------------------------------------------------------
*/

Route::get('/blogs', [PageController::class, 'blogs'])
    ->name('blogs.index');

Route::get('/blogs/{slug}', [PageController::class, 'blogShow'])
    ->name('blogs.show');

/*
|--------------------------------------------------------------------------
| Contact
|--------------------------------------------------------------------------
*/

Route::get('/contact', [PageController::class, 'contact'])
    ->name('contact');

Route::post('/contact', [PageController::class, 'submitContact'])
    ->middleware('throttle:5,1')
    ->name('contact.submit');

/*
|--------------------------------------------------------------------------
| Dynamic CMS Pages
|--------------------------------------------------------------------------
*/

Route::get('/pages/{slug}', function (string $slug) {

    $page = Page::where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    return view('pages.show', compact('page'));

})->name('pages.show');
