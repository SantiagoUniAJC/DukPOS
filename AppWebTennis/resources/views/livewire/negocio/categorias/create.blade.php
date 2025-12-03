<?php

use Livewire\Volt\Component;
use App\Models\Categoria;

new class extends Component {
    public string $nombre = '';
    public string $descripcion = '';

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:2'],
            'descripcion' => ['required', 'string', 'min:2'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.min' => 'El contenido es demasiado corto.',
        ];
    }

    public function createCategoria()
    {
        $this->validate();

        $categoria = Categoria::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);
        $this->reset();

        return redirect()->route('categorias.index')->with('success', 'Categoria creada exitosamente.');
    }
}; ?>


<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white text-center">
            {{ __('Formulario de Creación de Categorias.') }}
        </h1>
        <br>
    </x-slot>
    <div class="max-w-6xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">
        <form wire:submit.prevent='createCategoria' enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <x-input-field name="nombre" label="Nombre" type="text" model="nombre" autocomplete="given-name" />

                <x-input-field name="descripcion" label="Descripción" type="text" model="descripcion"
                    autocomplete="family-name" />
            </div>
            <div class="mt-2 flex justify-center">
                <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Crear Categoria</span>
                    <span wire:loading>Creando...</span>
                </flux:button>
            </div>

        </form>
    </div>
</div>
