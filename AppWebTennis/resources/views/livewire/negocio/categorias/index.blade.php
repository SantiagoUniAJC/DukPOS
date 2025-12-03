<?php

use Livewire\Volt\Component;
use App\Models\Categoria;
use App\Traits\Buscar;

new class extends Component {
    // Incluir el trait Buscar para agregar funcionalidad de búsqueda
    use Buscar;

    public $search = '';

    protected $listeners = ['disable'];

    public function with(): array
    {
        return [
            'categorias' => Categoria::buscar($this->search)->orderBy('id', 'desc')->paginate(7),
        ];
    }

    public function disable($categoriaId)
    {
        if (Categoria::where('id', $categoriaId)->where('estado', 'Inactivo')->exists()) {
            return redirect()->route('categorias.index')->with('danger', 'Categoria ya está desactivada');
        } else {
            Categoria::where('id', $categoriaId)->update(['estado' => 'Inactivo']);

            return redirect()->route('categorias.index')->with('success', 'Categoria desactivada correctamente');
        }
    }
}; ?>

<div class="px-4 sm:px-6 lg:px-8">
    <x-slot name="header">
        <h1 class="text-2xl text-center font-semibold text-gray-900 dark:text-white">
            {{ __('Lista de Categorias Registradas.') }}
        </h1>
        <br>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
        <div>
            <a href="{{ route('categorias.create') }}"
                class="inline-block px-3 py-1.5 bg-green-900 text-white rounded-md hover:bg-green-600 transition">
                <i class="user-plus"></i> {{ __('Crear Categoria') }}
            </a>
        </div>

        <div class="w-full max-w-md mx-auto">
            <input wire:model.live="search"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-zinc-800 dark:text-white"
                placeholder="Búsqueda por nombre" />
            <div wire:loading>
                <span>Buscando Categoria ......</span>
            </div>
        </div>
    </div>

    @if ($categorias->count() == 0)
        <div class="mt-4">
            <h5>{{ $search }}!</h5>
            <p>No se encontraron registros con los criterios de búsqueda ingresados.</p>
        </div>
    @else
        <div class="w-full mt-4 overflow-x-auto">
            <x-table :items="$categorias" :columns="[
                'Nombre',
                'Descripción',
                'Fecha de Creación',
                'Fecha de Actualización',
                'Usuario de Actualización',
                'Estado',
            ]" :fields="['nombre', 'descripcion', 'created_at', 'updated_at', 'actualizado_por', 'estado']" :hasActions="true" editRoute="categorias.edit" />
        </div>
    @endif

    <div class="mt-4">

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (typeof Livewire !== 'undefined') {
                    Livewire.on('confirmdesactivar', function(categoriaId) {
                        Swal.fire({
                            title: "¿Estás seguro que deseas desactivar esta Categoria?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Sí",
                            cancelButtonText: "Cancelar"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Livewire.dispatch('disable', {
                                    categoriaId: categoriaId
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
