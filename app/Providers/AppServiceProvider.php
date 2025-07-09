<?php

namespace App\Providers;

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
        // Tidak perlu mendaftarkan komponen secara manual di Laravel 12
        // Laravel akan otomatis menemukan komponen di resources/views/components
    }
}
