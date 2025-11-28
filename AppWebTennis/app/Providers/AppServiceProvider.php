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
        // Muestra el total de usuarios en el header
        view()->composer('components.layouts.app.header', function ($view) {
            $totalUsers = \App\Models\User::count();
            $view->with('totalUsers', $totalUsers);
        });
    }
}
