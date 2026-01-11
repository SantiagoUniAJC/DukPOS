<?php

use Livewire\Volt\Component;
use App\Models\Sucursal;

new class extends Component {
    public $search = '';

    protected $listeners = ['disable'];

    public function with(): array
    {
        return [
            'sucursales' => Sucursal::buscar($this->search)
                ->with('inventario')
                ->where('estado', 'activo')
                ->orderBy('id', 'desc')
                ->paginate(7),
        ];
    }

    public function disable($sucursalId)
    {
        if (Sucursal::where('id', $sucursalId)->where('estado', 'Inactivo')->exists()) {
            return redirect()->route('negocio.sucursales.index')->with('danger', 'Sucursal ya está desactivada');
        } else {
            Sucursal::where('id', $sucursalId)->update(['estado' => 'Inactivo']);

            return redirect()->route('negocio.sucursales.index')->with('success', 'Sucursal desactivada correctamente');
        }
    }
}; ?>

<div class="px-4 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h1 class="text-2xl text-center font-semibold text-gray-900 dark:text-white">
            {{ __('Lista de Sucursales Registradas.') }}
        </h1>
        <br>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
        <div>
            <a href="{{ route('negocio.sucursales.create') }}"
                class="inline-block px-3 py-1.5 bg-green-900 text-white rounded-md hover:bg-green-600 transition">
                <i class="user-plus"></i> {{ __('Crear Sucursal') }}
            </a>
        </div>

        <div class="w-full max-w-md mx-auto">
            <input wire:model.live="search"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-zinc-800 dark:text-white"
                placeholder="Búsqueda por nombre" />
            <div wire:loading>
                <span>Buscando Sucursal ......</span>
            </div>
        </div>
    </div>

    @if ($sucursales->count() == 0)
        <div class="mt-4">
            <h5>{{ $search }}!</h5>
            <p>No se encontraron registros con los criterios de búsqueda ingresados.</p>
        </div>
    @else
        <div class="w-full mt-4 overflow-x-auto">
            <x-table :items="$sucursales" :columns="[
                'Codigo',
                'Nombre',
                'Direccion',
                'Telefono',
                'Email',
                'Usuario Asignado',
                'Stock Disponible',
                'Stock Mínimo',
                //'Fecha de Creación',
                //'Estado',
            ]" :fields="[
                'codigo',
                'nombre',
                'direccion',
                'telefono',
                'email',
                'usuario.nombres',
                'inventario.stock_disponible',
                'inventario.stock_minimo',
                //'created_at',
                //'estado',
            ]" :hasActions="true"
                editRoute="negocio.sucursales.edit" />
        </div>
    @endif

    <div class="mt-4">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Livewire !== 'undefined') {
                    Livewire.on('confirmdesactivar', function(sucursalId) {
                        Swal.fire({
                            title: "¿Estás seguro que deseas desactivar esta Sucursal?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Sí",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Livewire.dispatch('disable', {
                                    sucursalId: sucursalId
                                });
                            }
                        });
                    });
                } else {
                    console.warn('Livewire no está definido aún. Script de confirmación omitido.');
                }
            });
        </script>
    </div>
</div>
