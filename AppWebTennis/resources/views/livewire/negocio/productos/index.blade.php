<?php

use Livewire\Volt\Component;
use App\Models\Producto;
use App\Traits\Buscar;

new class extends Component {
    
    use Buscar;

    public $search = '';

    protected $listeners = ['disable'];

    public function with(): array
    {
        return [
            'productos' => Producto::buscar($this->search, ['nombre', 'marca.nombre'])
                ->with('marca')
                ->withCount('variante')
                ->where('estado', 'activo')
                ->orderBy('id', 'desc')
                ->paginate(5),
        ];
    }

    public function disable($productoId)
    {
        if (Producto::where('id', $productoId)->where('estado', 'Inactivo')->exists()) {
            return redirect()->route('productos.index')->with('danger', 'Producto ya está desactivado');
        } else {

            Producto::where('id', $productoId)->update(['estado' => 'Inactivo']);

            return redirect()->route('productos.index')->with('success', 'Producto desactivado correctamente');
        }
    }
}; ?>

<div class="px-4 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h1 class="text-2xl text-center font-semibold text-gray-900 dark:text-white">
            {{ __('Lista de Productos Registrados.') }}
        </h1>
        <br>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
        <div>
            <a href="{{ route('productos.create') }}"
                class="inline-block px-3 py-1.5 bg-green-900 text-white rounded-md hover:bg-green-600 transition">
                <i class="user-plus"></i> {{ __('Crear Producto') }}
            </a>
        </div>

        <div class="w-full max-w-md mx-auto">
            <input wire:model.live="search"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-zinc-800 dark:text-white"
                placeholder="Búsqueda por nombre" />
            <div wire:loading>
                <span>Buscando Producto ......</span>
            </div>
        </div>
    </div>

    @if ($productos->count() == 0)
        <div class="mt-4">
            <h5>{{ $search }}!</h5>
            <p>No se encontraron registros con los criterios de búsqueda ingresados.</p>
        </div>
    @else
        <div class="w-full mt-4 overflow-x-auto">
            <x-table :items="$productos" :columns="[
                'Marca',
                'Categoria',
                'Nombre',
                'Descripción',
                'Imagen',
                'Variantes',
                'Inventario',
                'Fecha de Creación',
                //'Estado',
            ]" :fields="[
                'marca.nombre',
                'categoria.nombre',
                'nombre',
                'descripcion',
                'imagen',
                'variante_count',
                'producto_inventario_count',
                'created_at',
                //'estado',
            ]" :hasActions="true"
                editRoute="productos.edit"
                showRoute="productos.variantes.index" />
        </div>
    @endif

    <div class="mt-4">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Livewire !== 'undefined') {
                    Livewire.on('confirmdesactivar', function(productoId) {
                        Swal.fire({
                            title: "¿Estás seguro que deseas desactivar este Producto?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Sí",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Livewire.dispatch('disable', {
                                    productoId: productoId
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
