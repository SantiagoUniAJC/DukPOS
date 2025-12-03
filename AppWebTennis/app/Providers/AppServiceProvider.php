<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;

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
            $totalUsers = User::count();
            $view->with('totalUsers', $totalUsers);
        });

        // Muestra el total de categorias en el header
        view()->composer('components.layouts.app.header', function ($view) {
            $totalCategorias = Categoria::count();
            $view->with('totalCategorias', $totalCategorias);
        });

        // Muestra el total de marcas en el header
        view()->composer('components.layouts.app.header', function ($view) {
            $totalMarcas = Marca::count();
            $view->with('totalMarcas', $totalMarcas);
        });

        // Muestra el total de productos en el header
        view()->composer('components.layouts.app.header', function ($view) {
            $totalProductos = Producto::count();
            $view->with('totalProductos', $totalProductos);
        });
    }
}
