<?php

use Livewire\Volt\Component;
use App\Models\Producto;
use App\Models\Sucursal;
use App\Models\Variante;

new class extends Component {
    public $producto_id;
    public $productos = [];
    public $sucursal_id;
    public $sucursales = [];

    public $sku, $talla, $color, $codigo_barras, $precio_costo, $precio_venta, $stock;

    public function mount(): void
    {
        $this->productos = Producto::pluck('nombre', 'id')->toArray();
        $this->sucursales = Sucursal::pluck('nombre', 'id')->toArray();
    }

    public function rules(): array
    {
        return [
            'producto_id' => ['required', 'exists:productos,id'],
            'sucursal_id' => ['required', 'exists:sucursales,id'],
            'talla' => ['required', 'string', 'min:1'],
            'color' => ['required', 'string', 'min:1'],
            'codigo_barras' => ['nullable', 'string', 'min:1'],
            'precio_costo' => ['required', 'numeric', 'min:0'],
            'precio_venta' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.min' => 'El contenido es demasiado corto.',
            'producto_id.exists' => 'El producto seleccionado no es válido.',
            'sucursal_id.exists' => 'La sucursal seleccionada no es válida.',
            'sku.unique' => 'El SKU ya está en uso.',
        ];
    }

    public function createVariante()
    {
        $this->validate();

        

        $variante = Variante::create([
            'producto_id' => $this->producto_id,
            'sucursal_id' => $this->sucursal_id,
            'talla' => $this->talla,
            'color' => $this->color,
            'codigo_barras' => $this->codigo_barras,
            'precio_costo' => $this->precio_costo,
            'precio_venta' => $this->precio_venta,
            'stock' => $this->stock,
        ]);

        return redirect()
            ->route('productos.variantes.index', ['producto' => $this->producto_id])
            ->with('success', 'Producto creado exitosamente.');
    }
}; ?>

<div>
    <x-slot name="header">
        <h1 class="text-3xl font-semibold text-gray-900 dark:text-white text-center">
            {{ __('Formulario de Creación de Variantes de Productos.') }}
        </h1>
        <flux:separator class="mt-4 mb-4" /><br>
    </x-slot>
    <div class="max-w-7xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">
        <form wire:submit.prevent='createVariante' enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-6">

                {{-- producto_id --}}
                <x-select-field name="producto_id" label="Producto" model="producto_id" :options="$productos"
                    placeholder="Seleccione un producto" />

                {{-- Sucursal_id --}}
                <x-select-field name="sucursal_id" label="Sucursal" model="sucursal_id" :options="$sucursales"
                    placeholder="Seleccione una sucursal" />

                <x-input-field name="talla" label="Talla" type="text" model="talla" autocomplete="given-name" />

                <x-input-field name="color" label="Color" type="text" model="color" autocomplete="given-name" />

                <x-input-field name="codigo_barras" label="Código de Barras" type="text" model="codigo_barras"
                    autocomplete="given-name" />

                {{-- precio --}}
                <x-input-field name="precio_costo" label="Precio Costo" type="text" model="precio_costo"
                    autocomplete="given-name" />

                <x-input-field name="precio_venta" label="Precio Venta" type="text" model="precio_venta"
                    autocomplete="given-name" />

                <x-input-field name="stock" label="Stock" type="number" model="stock" autocomplete="given-name" />

            </div>
            <div class="mt-2 flex justify-center">
                <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Crear Producto</span>
                    <span wire:loading>Creando...</span>
                </flux:button>
            </div>
        </form>
    </div>
</div>
