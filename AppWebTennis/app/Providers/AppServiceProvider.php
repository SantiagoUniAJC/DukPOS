<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Observers\SucursalObserver;
use App\Models\Variante;
use App\Observers\VarianteObserver;

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
        // Muestra el total de usuarios en el sidebar
        view()->composer('components.layouts.app.sidebar', function ($view) {
            $totalUsers = User::count();
            $view->with('totalUsers', $totalUsers);
        });

        // Muestra el total de categorias en el sidebar
        view()->composer('components.layouts.app.sidebar', function ($view) {
            $totalCategorias = Categoria::count();
            $view->with('totalCategorias', $totalCategorias);
        });

        // Muestra el total de marcas en el sidebar
        view()->composer('components.layouts.app.sidebar', function ($view) {
            $totalMarcas = Marca::count();
            $view->with('totalMarcas', $totalMarcas);
        });

        // Muestra el total de productos en el sidebar
        view()->composer('components.layouts.app.sidebar', function ($view) {
            $totalProductos = Producto::count();
            $view->with('totalProductos', $totalProductos);
        });

        // Muestra el total de sucursales en el sidebar
        view()->composer('components.layouts.app.sidebar', function ($view) {
            $totalSucursales = Sucursal::count();
            $view->with('totalSucursales', $totalSucursales);
        });

        /** Observer para crear el código único de la sucursal */
        Sucursal::observe(SucursalObserver::class);

        /** Observer para crear el código único de variante producto */
        Variante::observe(VarianteObserver::class);

    }
}
