<?php

use Livewire\Volt\Component;
use App\Models\Proveedor;
use App\Models\Marca;

new class extends Component {
    
    public $nombre;
    public $proveedor_id;
    public $proveedores = [];

    public function mount()
    {
        $this->proveedores = Proveedor::where('estado', 'activo')->pluck('razon_social', 'id')->toArray();
    }

    protected $rules = [
        'nombre' => 'required|string|max:255|unique:marcas,nombre',
        'proveedor_id' => 'required|exists:proveedores,id',
    ];

    public function createMarca()
    {
        $this->validate();

        Marca::create([
            'nombre' => $this->nombre,
            'proveedor_id' => $this->proveedor_id,
        ]);

        return redirect()->route('marcas.index')->with('success', 'Marca creada exitosamente.');
    }
}; ?>

<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white text-center">
            {{ __('Formulario de Creación de Marcas.') }}
        </h1>
        <flux:separator class="mt-4 mb-4" /><br>
    </x-slot>
    <div class="max-w-7xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">
        <form wire:submit.prevent='createMarca' enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-2 gap-6">

                <x-input-field name="nombre" label="Nombre" type="text" model="nombre"
                    autocomplete="given-name" />

                <x-select-field name="proveedor_id" label="Proveedor" :options="$proveedores" model="proveedor_id"
                    placeholder="Seleccione un proveedor" />

            </div>
            <div class="mt-2 flex justify-center">
                <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Crear Marca</span>
                    <span wire:loading>Creando...</span>
                </flux:button>
            </div>
        </form>
    </div>
</div>
