<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Video;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // HOME SECTION: ONLY YOUTUBE VIDEOS
        View::composer('frontend.home.sections.videos', function ($view) {
            $view->with(
                'videos',
                Video::query()
                    ->where('platform', 'youtube')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderByDesc('id')
                    ->get()
            );
        });

        // HOME SECTION: ONLY INSTAGRAM REELS
        View::composer('frontend.home.sections.instagram-reels', function ($view) {
            $view->with(
                'instagramReels',
                Video::query()
                    ->where('platform', 'instagram')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderByDesc('id')
                    ->get()
            );
        });
    }
}
