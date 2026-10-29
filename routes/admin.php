<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminAuthController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use App\Http\Controllers\Admin\ServiceCategoryController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\AcademyCourseController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\AppointmentController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware('guest')->group(function () {

    Route::get('/login', [
        AdminAuthController::class,
        'showLogin'
    ])->name('login');

    Route::post('/login', [
        AdminAuthController::class,
        'login'
    ])->middleware('throttle:5,1')->name('login.submit');

});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');

    Route::get('/settings', [
        WebsiteSettingController::class,
        'index'
    ])->name('settings.index');

    Route::put('/settings', [
        WebsiteSettingController::class,
        'update'
    ])->name('settings.update');

    Route::resource(
        'service-categories',
        ServiceCategoryController::class
    )->except(['show']);

    Route::resource('services', ServiceController::class)
        ->except(['show']);

    Route::resource('gallery-categories', GalleryCategoryController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource('gallery-images', GalleryImageController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource(
        'academy-courses',
        AcademyCourseController::class
    )->except(['show']);

    Route::resource('blogs', BlogController::class)->except(['show']);

    Route::resource('blog-categories', BlogCategoryController::class)
        ->only(['index', 'store', 'update', 'destroy']);

    Route::resource(
        'appointments',
        AppointmentController::class
    )->except(['show']);

    Route::resource(
        'enquiries',
        EnquiryController::class
    )->except(['show']);

    Route::resource(
        'branches',
        BranchController::class
    )->except(['show']);

    Route::resource('pages', PageController::class)
        ->except(['show']);

    Route::post('/logout', [
        AdminAuthController::class,
        'logout'
    ])->name('logout');

});
