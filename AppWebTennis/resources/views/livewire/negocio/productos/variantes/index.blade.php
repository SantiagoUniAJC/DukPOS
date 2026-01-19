<?php

use Livewire\Volt\Component;
use App\Models\Variante;
use App\Models\Producto;
use App\Models\Sucursal;

new class extends Component {
    public $search = '';
    public Producto $producto;

    protected $listeners = ['disable'];

    public function with(): array
    {
        return [
            'variantes' => Variante::buscar($this->search, ['sku'])
                ->where('producto_id', $this->producto->id)
                ->where('estado', 'activo')
                ->orderBy('id', 'desc')
                ->paginate(7),
        ];
    }

    public function disable($varianteId)
    {
        if (Variante::where('id', $varianteId)->where('estado', 'Inactivo')->exists()) {
            return redirect()->route('productos.variantes.index', $this->producto->id)->with('danger', 'Variante ya está desactivada');
        } else {
            Variante::where('id', $varianteId)->update(['estado' => 'Inactivo']);

            return redirect()->route('productos.variantes.index', $this->producto->id)->with('success', 'Variante desactivada correctamente');
        }
    }
}; ?>

<div class="px-4 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h1 class="text-2xl text-center font-semibold text-gray-900 dark:text-white">
            {{ __('Lista de Variantes Registrados.') }}
        </h1>
        <br>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
        <div>
            <a href="{{ route('productos.variantes.create', $producto->id) }}"
                class="inline-block px-3 py-1.5 bg-green-900 text-white rounded-md hover:bg-green-600 transition">
                <i class="user-plus"></i> {{ __('Crear Variante Producto') }}
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

    @if ($variantes->count() == 0)
        <div class="mt-4">
            <h5>{{ $search }}!</h5>
            <p>No se encontraron registros con los criterios de búsqueda ingresados.</p>
        </div>
    @else
        <div class="w-full mt-4 overflow-x-auto">
            <x-table :items="$variantes" :columns="[
                'Codigo',
                'Nombre',
                'Talla',
                'Color',
                'codigo de barras',
                //'descripcion',
                'precio',
                // 'Stock',
                //'Fecha de Creación',
                //'Estado',
            ]" :fields="[
                'sku',
                'producto.marca_nombre',
                'talla',
                'color',
                'codigo_barras',
                //'descripcion',
                'precio_venta',
                // 'inventario.stock_actual',
                //'created_at',
                //'estado',
            ]" :hasActions="true"
                editRoute="productos.variantes.edit" />
        </div>
    @endif

    <div class="mt-4">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Livewire !== 'undefined') {
                    Livewire.on('confirmdesactivar', function(varianteId) {
                        Swal.fire({
                            title: "¿Estás seguro que deseas desactivar este Variante?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Sí",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Livewire.dispatch('disable', {
                                    varianteId: varianteId
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
