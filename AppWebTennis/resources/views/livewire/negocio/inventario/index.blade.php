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
            'productos' => Producto::buscar($this->search, ['nombre', 'marca.nombre', 'categoria.nombre'])
                ->with('marca', 'categoria')
                ->withCount('variante')
                // ->withSum('variante.inventarios', 'stock') // <- inventario total
                ->orderBy('created_at', 'desc')
                ->paginate(8),
        ];
    }
}; ?>

<div class="px-4 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h1 class="text-2xl text-center font-semibold text-gray-900 dark:text-white">
            {{ __('Inventario de Productos Registrados.') }}
        </h1>
        <br>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">

        <div class="w-full max-w-md mx-auto">
            <input wire:model.live="search"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-zinc-800 dark:text-white"
                placeholder="Búsqueda por nombre" />
            <div wire:loading>
                <span>Buscando inventario ......</span>
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
            <x-table :items="$productos" :columns="['Marca', 'Categoria', 'Nombre', 'Variantes', 'Inventario', 'Fecha de Creación']" :fields="[
                'marca.nombre',
                'categoria.nombre',
                'nombre',
                'variante_count',
                'stock_actual',
                'created_at',
            ]" :hasActions="false"
                editRoute="inventarios.edit" showRoute="inventarios.variantes.index" />
        </div>
    @endif

    <div class="mt-4">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Livewire !== 'undefined') {
                    Livewire.on('confirmdesactivar', function(productoId) {
                        Swal.fire({
                            title: "¿Estás seguro que deseas desactivar este inventario?",
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
