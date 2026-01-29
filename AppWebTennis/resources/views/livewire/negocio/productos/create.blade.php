<?php

use Livewire\Volt\Component;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use Livewire\WithFileUploads;

new class extends Component {

    use WithFileUploads;

    public $categoria_id;
    public $categorias = [];
    public $marca_id;
    public $marcas = [];

    public $nombre;
    public $descripcion;
    public $imagen;

    public function mount(): void
    {
        $this->categorias = Categoria::pluck('nombre', 'id')->toArray();
        $this->marcas = Marca::pluck('nombre', 'id')->toArray();
    }

    public function rules(): array
    {
        return [
            'categoria_id' => ['required', 'exists:categorias,id'],
            'marca_id' => ['required', 'exists:marcas,id'],
            'nombre' => ['required', 'string', 'min:2'],
            'descripcion' => ['required', 'string', 'min:2'],
            'imagen' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.min' => 'El contenido es demasiado corto.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'sku.unique' => 'El SKU ya está en uso.',
            'imagen.image' => 'El archivo debe ser una imagen.',
            'imagen.max' => 'La imagen no debe superar los 2MB.',
        ];
    }

    public function createProducto()
    {
        $this->validate();

        $nombreImagen = $this->imagen->getClientOriginalName();
        $this->imagen->storeAs('images/productos', $nombreImagen, 'public');

        $producto = Producto::create([
            'categoria_id' => $this->categoria_id,
            'marca_id' => $this->marca_id,
     
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'imagen' => $nombreImagen,
        ]);

         return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }
}; ?>

<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white text-center">
            {{ __('Formulario de Creación de Productos.') }}
        </h1>
        <flux:separator class="mt-4 mb-4" /><br>
    </x-slot>
    <div class="max-w-7xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">
        <form wire:submit.prevent='createProducto' enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-6">

                {{-- Categoria_id --}}
                <x-select-field name="categoria_id" label="Categoría" model="categoria_id" :options="$categorias"
                    placeholder="Seleccione una categoría" />
                
                    {{-- Marca_id --}}
                <x-select-field name="marca_id" label="Marca" model="marca_id" :options="$marcas"
                    placeholder="Seleccione una marca" />

                <x-input-field name="nombre" label="Nombre" type="text" model="nombre" autocomplete="given-name" />

                <x-input-field name="descripcion" label="Descripción" type="text" model="descripcion"
                    autocomplete="description" />

                {{-- imagen --}}
                <x-input-field name="imagen" label="Imagen" type="file" model="imagen" accept="image/*" />
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
