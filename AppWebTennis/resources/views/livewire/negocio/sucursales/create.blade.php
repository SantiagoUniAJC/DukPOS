<?php

use Livewire\Volt\Component;
use App\Models\User;
use App\Models\Sucursal;

new class extends Component {
    public $user_id;
    public $usuarios = [];

    public $nombre;
    public $descripcion;
    public $direccion;
    public $telefono;
    public $email;

    public function mount(): void
    {
        $this->usuarios = User::pluck('nombres', 'id')->toArray();
    }

    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'nombre' => ['required', 'string', 'min:2'],
            'direccion' => ['required', 'string', 'min:2'],
            'telefono' => ['required', 'string', 'min:2'],
            'email' => ['required', 'email'],

        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.min' => 'El contenido es demasiado corto.',
            'user_id.exists' => 'La categoría seleccionada no es válida.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'codigo.unique' => 'El código ya está en uso.',
        ];
    }

    public function createSucursal()
    {
        $this->validate();

        $sucursal = Sucursal::create([
            'user_id' => $this->user_id,

            'nombre' => $this->nombre,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email,
        ]);

        return redirect()->route('negocio.sucursales.index')->with('success', 'Sucursal creada exitosamente.');
    }
}; ?>


<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white text-center">
            {{ __('Formulario de Creación de Sucursales.') }}
        </h1>
        <flux:separator class="mt-4 mb-4" /><br>
    </x-slot>
    <div class="max-w-7xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">
        <form wire:submit.prevent='createSucursal' enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-6">

                {{-- Usuario Encargado --}}
                <x-select-field name="user_id" label="Usuario Encargado" model="user_id" :options="$usuarios"
                    placeholder="Seleccione un usuario" />

                <x-input-field name="nombre" label="Nombre" type="text" model="nombre" autocomplete="given-name" />

                <x-input-field name="direccion" label="Dirección" type="text" model="direccion"
                    autocomplete="address-line1" />

                <x-input-field name="telefono" label="Teléfono" type="text" model="telefono" autocomplete="tel" />

                <x-input-field name="email" label="Email" type="email" model="email" autocomplete="email" />
            </div>
            <div class="mt-2 flex justify-center">
                <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Crear Sucursal</span>
                    <span wire:loading>Creando...</span>
                </flux:button>
            </div>
        </form>
    </div>
</div>
