<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', DashboardController::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('auth.index', 'auth/index')->name('auth.index');
    Volt::route('auth.create', 'auth/create')->name('auth.create');
    Volt::route('auth.edit/{user}', 'auth/edit')->name('auth.edit');
    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('user-password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

Route::middleware(['web'])->group(function () {
    Volt::route('negocio/categorias', 'negocio.categorias.index')
        ->name('categorias.index');
    Volt::route('negocio/categorias/create', 'negocio.categorias.create')
        ->name('categorias.create');
    Volt::route('negocio/categorias/edit/{categoria}', 'negocio.categorias.edit')
        ->name('categorias.edit');
});

Route::middleware(['web'])->group(function () {
    Volt::route('negocio/marcas', 'negocio.marcas.index')
        ->name('marcas.index');
    Volt::route('negocio/marcas/create', 'negocio.marcas.create')
        ->name('marcas.create');
    Volt::route('negocio/marcas/edit/{marca}', 'negocio.marcas.edit')
        ->name('marcas.edit');
});

Route::middleware(['web'])->group(function () {
    Volt::route('negocio/productos', 'negocio.productos.index')
        ->name('productos.index');
    Volt::route('negocio/productos/create', 'negocio.productos.create')
        ->name('productos.create');
    Volt::route('negocio/productos/edit/{producto}', 'negocio.productos.edit')
        ->name('productos.edit');

    // Variantes productos    
    Volt::route('negocio/productos/{producto}/variantes', 'negocio.productos.variantes.index')
        ->name('productos.variantes.index');
    Volt::route('negocio/productos/{producto}/variantes/create', 'negocio.productos.variantes.create')
        ->name('productos.variantes.create');
    Volt::route('negocio/productos/variantes/edit/{variante}', 'negocio.productos.variantes.edit')
        ->name('productos.variantes.edit');

    // Sucursales    
    Volt::route('negocio/sucursales', 'negocio.sucursales.index')
        ->name('negocio.sucursales.index');
    Volt::route('negocio/sucursales/create', 'negocio.sucursales.create')
        ->name('negocio.sucursales.create');
    Volt::route('negocio/sucursales/edit/{sucursal}', 'negocio.sucursales.edit')
        ->name('negocio.sucursales.edit');

    // Inventario    
    Volt::route('negocio/inventario', 'negocio.inventario.index')
        ->name('negocio.inventario.index');
    Volt::route('negocio/inventario/create', 'negocio.inventario.create')
        ->name('negocio.inventario.create');
});
