<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        if (app()->environment('production')) {
            \URL::forceScheme('https');
        }

        // Admin panel (AdminLTE) and auth pages are Bootstrap 4 — Laravel's
        // default pagination view uses unstyled Tailwind SVG icons that
        // render huge without Tailwind's CSS loaded, so use Bootstrap's here.
        Paginator::useBootstrap();
    }
}
