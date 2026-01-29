<?php

use Livewire\Volt\Component;
use App\Models\Proveedor;

new class extends Component {
    public $razon_social;
    public $nit;
    public $direccion;
    public $telefono;
    public $email;
    public $contacto;

    public function rules(): array
    {
        return [
            'razon_social' => ['required', 'string', 'min:2'],
            'nit' => ['required', 'string', 'min:2'],
            'direccion' => ['required', 'string', 'min:2'],
            'telefono' => ['required', 'string', 'min:7'],
            'email' => ['required', 'email'],
            'contacto' => ['required', 'string', 'min:2'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.min' => 'El contenido es demasiado corto.',
            'email.email' => 'El correo electrónico no es válido.',
        ];
    }

    public function createProveedor()
    {
        $this->validate();

        Proveedor::create([
            'razon_social' => $this->razon_social,
            'nit' => $this->nit,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'contacto' => $this->contacto,
        ]);

        return redirect()->route('negocio.proveedores.index')->with('success', 'Proveedor creado exitosamente.');
    }
}; ?>


<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white text-center">
            {{ __('Formulario de Creación de Proveedor.') }}
        </h1>
        <flux:separator class="mt-4 mb-4" /><br>
    </x-slot>
    <div class="max-w-7xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">
        <form wire:submit.prevent='createProveedor' enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-6">

                <x-input-field name="razon_social" label="Razón Social" type="text" model="razon_social"
                    autocomplete="given-name" />

                <x-input-field name="nit" label="NIT" type="text" model="nit" autocomplete="nit" />

                <x-input-field name="direccion" label="Dirección" type="text" model="direccion"
                    autocomplete="address" />

                <x-input-field name="telefono" label="Teléfono" type="text" model="telefono" autocomplete="tel" />

                <x-input-field name="email" label="Email" type="email" model="email" autocomplete="email" />

                {{-- contacto encargado --}}
                <x-input-field name="contacto" label="Contacto Encargado" type="text" model="contacto"
                    autocomplete="contact" />

            </div>
            <div class="mt-2 flex justify-center">
                <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Crear Proveedor</span>
                    <span wire:loading>Creando...</span>
                </flux:button>
            </div>
        </form>
    </div>
</div>
