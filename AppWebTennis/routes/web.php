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

    Volt::route('index', 'auth/index')->name('index');
    Volt::route('create', 'auth/create')->name('create');
    Volt::route('edit/{user}', 'auth/edit')->name('edit');
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
});

Route::middleware(['web'])->group(function () {
    Volt::route('negocio/marcas', 'negocio.marcas.index')
        ->name('marcas.index');
    Volt::route('negocio/marcas/create', 'negocio.marcas.create')
        ->name('marcas.create');
    Volt::route('negocio/marcas/edit/{marca}', 'negocio.marcas.edit')
        ->name('marcas.edit');
});
