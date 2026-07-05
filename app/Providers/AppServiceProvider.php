<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // Tambahkan ini

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
        // Paksa aplikasi menggunakan HTTPS jika diakses lewat Ngrok/Production
        if (env('APP_ENV') !== 'local' || request()->header('x-forwarded-proto') === 'https') {
            URL::forceScheme('https');
        }
    }
}
