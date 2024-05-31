<?php

namespace App\Providers;

use App\Models\LogoName;
use Illuminate\Support\ServiceProvider;

class LogoNameServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $LogoName = LogoName::first();
            $view->with('LogoName', $LogoName);
        });
    }
}
