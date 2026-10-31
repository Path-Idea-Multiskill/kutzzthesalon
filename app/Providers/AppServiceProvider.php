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
        View::composer('frontend.home.sections.videos', function ($view) {
            $view->with(
                'videos',
                Video::query()
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->orderByDesc('id')
                    ->get()
            );
        });
    }
}
