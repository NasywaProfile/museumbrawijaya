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

    public function boot(): void
    {
        $host = request()->getHost();
        if ($host !== 'localhost' && $host !== '127.0.0.1') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
