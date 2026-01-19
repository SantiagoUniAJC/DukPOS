<?php

use Livewire\Volt\Component;
use App\Models\Variante;
use App\Models\Sucursal;
use App\Models\Inventario;

new class extends Component {
    public $variante_id;
    public $variantes = [];
    
    public $sucursal_id = null;
    public $sucursales = [];

    public $stock_actual;

    public function mount(): void
    {
        $this->variantes = Variante::pluck('sku', 'id')->toArray();
        $this->sucursales = Sucursal::pluck('nombre', 'id')->toArray();
    }

    public function updated($property)
    {
        if (in_array($property, ['variante_id', 'sucursal_id'])) {
            $this->cargarStock();
        }
    }

    public function cargarStock()
    {
        if ($this->variante_id && $this->sucursal_id) {
            $this->stock_actual = Inventario::where('variante_id', $this->variante_id)->where('sucursal_id', $this->sucursal_id)->value('stock_actual') ?? 0;
        } else {
            $this->stock_actual = null;
        }
    }

    public function rules(): array
    {
        return [
            'variante_id' => ['required', 'exists:variantes,id'],
            'sucursal_id' => ['required', 'exists:sucursales,id'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            'variante_id.exists' => 'La variante seleccionada no es válida.',
            'sucursal_id.exists' => 'La sucursal seleccionada no es válida.',
        ];
    }

    public function createInventario()
    {
        $this->validate();

        Inventario::updateOrCreate(
            [
                'variante_id' => $this->variante_id,
                'sucursal_id' => $this->sucursal_id,
            ],
            [
                'stock_actual' => $this->stock_actual,
            ]
        );

        return redirect()
            ->route('negocio.inventario.index')
            ->with('success', 'Inventario actualizado exitosamente.');
    }
}; ?>


<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white text-center">
            {{ __('Formulario para Agregar Productos al Inventario.') }}
        </h1>
        <br>
    </x-slot>
    <div class="max-w-6xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">

        <form wire:submit.prevent='createInventario' enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-6">
                <x-select-field name="variante_id" label="Variante" model="variante_id" :options="$variantes"
                    placeholder="Seleccione una variante" />

                <x-select-field name="sucursal_id" label="Sucursal" model="sucursal_id" :options="$sucursales"
                    placeholder="Seleccione una sucursal" />

                <x-input-field name="stock_actual" label="Stock Actual" type="text" model="stock_actual" />
            </div>
            <div class="mt-2 flex justify-center">
                <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Agregar Inventario a Sucursal</span>
                </flux:button>
            </div>
        </form>
    </div>
</div>
