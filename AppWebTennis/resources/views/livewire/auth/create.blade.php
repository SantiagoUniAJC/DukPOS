<?php

use Livewire\Volt\Component;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;

new class extends Component {
    public string $nombres = '';
    public string $apellidos = '';
    public string $telefono = '';
    public string $cargo = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function rules(): array
    {
        return [
            'nombres' => ['required', 'string', 'min:2'],
            'apellidos' => ['required', 'string', 'min:2'],
            'telefono' => ['required', 'regex:/^3\d{9}$/', 'digits:10', 'unique:users,telefono'],
            'cargo' => ['nullable', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.min' => 'El contenido es demasiado corto.',
            'telefono.regex' => 'El número debe tener 10 dígitos y comenzar con 3.',
            'telefono.unique' => 'Ya existe un usuario con este número de teléfono.',
            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Por favor, ingrese un correo electrónico válido.',
            'email.unique' => 'Este correo electrónico ya está en uso.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }

    public function updated($property)
    {
        $this->validateOnly($property);
    }

    public function createUser()
    {
        $this->validate();

        $user = User::create([
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
            'cargo' => $this->cargo,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        $this->reset();

        return redirect()->route('index')->with('success', 'Usuario creado exitosamente.');
    }
}; ?>

<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white text-center">
            {{ __('Formulario de Creación de Usuarios.') }}
        </h1>
        <br>
    </x-slot>
    <div class="max-w-6xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">
        <form wire:submit.prevent='createUser' enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-3 gap-6">
                <x-input-field name="nombres" label="Nombres" type="text" model="nombres" autocomplete="given-name" />

                <x-input-field name="apellidos" label="Apellidos" type="text" model="apellidos"
                    autocomplete="family-name" />

                <x-input-field name="telefono" label="Teléfono" type="text" model="telefono" />

                <x-input-field name="cargo" label="Cargo" model="cargo" />

                <x-input-field name="email" label="Email" type="email" model="email" />

                <x-input-field name="password" label="Contraseña" type="password" model="password" />
                <x-input-field name="password_confirmation" label="Confirmar Contraseña" type="password"
                    model="password_confirmation" />
            </div>
            <div class="mt-2 flex justify-center">
                <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                    <span wire:loading.remove>Crear Usuario</span>
                    <span wire:loading>Creando...</span>
                </flux:button>
            </div>

        </form>
    </div>
</div>
