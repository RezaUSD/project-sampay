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
        // Pakai pagination buatan sendiri biar keren dan pas di HP
        \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.sampay');

        if (config('app.env') === 'production') {
            \URL::forceScheme('https');
        }

        // Paksa Header HTTPS untuk Proxy Railway
        if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            \URL::forceScheme('https');
        }
    }
}
