<?php

use Livewire\Volt\Component;
use App\Models\Categoria;

new class extends Component {

    public Categoria $categoria;
    public string $nombre = '';
    public ?string $descripcion = '';

    public function mount(Categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->nombre = $categoria->nombre;
        $this->descripcion = $categoria->descripcion;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'string|min:2|max:255',
            'descripcion' => 'string|min:2|max:255',
        ];
    }

    public function updateCategoria()
    {
        $this->validate();

        $this->categoria->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoria actualizada exitosamente');
    }

    public function render(): mixed
    {
        return view('livewire.negocio.categorias.edit', ['categoria' => $this->categoria]);
    }

}; ?>
<div class="max-w-6xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-lg space-y-6">
    <h2 class="text-2xl font-bold text-center text-zinc-800 dark:text-white">Editar Categoria</h2>
    <hr class="border-gray-300 dark:border-zinc-700">

    <form wire:submit.prevent="updateCategoria" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input-field name="nombre" label="Nombre" type="text" model="nombre" />

            <x-input-field name="descripcion" label="Descripción" type="text" model="descripcion" />
        </div>

        <hr class="my-6 border-gray-300 dark:border-zinc-700">

        <div class="mt-2 flex justify-center md:grid-cols-2 gap-2">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Actualizar Categoria</span>
                <span wire:loading>Actualizando...</span>
            </flux:button>

            {{-- generar boton para regresar a la lista de categorias --}}
            <a class="button-blue" href="{{ route('categorias.index') }}">Regresar</a>
        </div>
    </form>
</div>
