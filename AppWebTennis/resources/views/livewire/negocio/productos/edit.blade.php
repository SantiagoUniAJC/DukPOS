<?php

use Livewire\Volt\Component;
use App\Models\Producto;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

new class extends Component {
    use WithFileUploads;

    public Producto $producto;
    public string $nombre = '';
    public ?string $descripcion = '';
    public $imagen = null;

    public function mount(Producto $producto)
    {
        $this->producto = $producto;
        $this->nombre = $producto->nombre;
        $this->descripcion = $producto->descripcion;
        $this->imagen = $producto->imagen;
    }

    public function updateProducto()
    {
        $data = [
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ];

        $nombreImagen = $this->imagen->getClientOriginalName();
        $this->imagen->storeAs('images/productos/', $nombreImagen, 'public');
        $data['imagen'] = $nombreImagen;

        $this->producto->update($data);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function render(): mixed
    {
        return view('livewire.negocio.productos.edit', ['producto' => $this->producto]);
    }
}; ?>

<div class="max-w-6xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-lg space-y-6">
    <h2 class="text-2xl font-bold text-center text-zinc-800 dark:text-white">Editar Producto</h2>
    <hr class="border-gray-300 dark:border-zinc-700">

    <form wire:submit.prevent="updateProducto" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input-field name="nombre" label="Nombre" type="text" model="nombre" />

            <x-input-field name="descripcion" label="Descripción" type="text" model="descripcion" />

            {{-- imagen actual: --}}
            <div class="col-span-1 md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Imagen Actual</label>
                @if ($producto->imagen)
                    <img src="{{ asset('images/productos/' . $producto->imagen) }}" alt="Imagen del Producto"
                        class="w-32 h-32 object-cover rounded-md">
                @else
                    <p class="text-sm text-gray-500 dark:text-gray-400">No hay imagen disponible.</p>
                @endif
            </div>

            {{-- subir nueva imagen --}}
            <div class="col-span-1 md:col-span-2">
                <x-input-field name="imagen" label="Subir Nueva Imagen" type="file" model="imagen"
                    accept="image*/" />
            </div>
        </div>

        <hr class="my-6 border-gray-300 dark:border-zinc-700">

        <div class="mt-2 flex justify-center md:grid-cols-2 gap-2">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Actualizar Producto</span>
                <span wire:loading>Actualizando...</span>
            </flux:button>

            {{-- generar boton para regresar a la lista de categorias --}}
            <a class="button-blue" href="{{ route('productos.index') }}">Regresar</a>
        </div>
    </form>
</div>
