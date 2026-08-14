<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // profil web (config/laundry.php) dipakai di semua halaman landing (topbar, footer, title, no wa admin)
        View::composer('home.*', function ($view) {
            $view->with('setting', app_setting());
        });
    }
}
