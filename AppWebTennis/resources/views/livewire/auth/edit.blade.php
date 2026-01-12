<?php

use Livewire\Volt\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

new class extends Component {

    public User $user;
    public $roles;
    public array $selectedRoles = [];

    public string $nombres = '';
    public string $apellidos = '';
    public string $telefono = '';
    public string $email = '';
    public ?string $cargo = '';

    public function mount(User $user)
    {
        $this->roles = Role::all();
        $this->user = $user;
        $this->selectedRoles = $this->user->roles->pluck('id')->toArray();

        $this->nombres = $user->nombres;
        $this->apellidos = $user->apellidos;
        $this->telefono = $user->telefono;
        $this->email = $user->email;
        $this->cargo = $user->cargo;
    }

    public function rules(): array
    {
        return [
            'nombres' => 'required|string|min:2|max:255',
            'apellidos' => 'required|string|min:2|max:255',
            'telefono' => [
                'required',
                'regex:/^3\d{9}$/',
                'digits:10',
                Rule::unique('users', 'telefono')->ignore($this->user->id),],
             'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ],
             'cargo' => 'nullable|string|max:255',
            'selectedRoles' => 'required|array',
            'selectedRoles.*' => 'exists:roles,id',
        ];
    }

    public function updateUser()
    {
        $this->validate();

        $this->user->update([
            'nombres' => $this->nombres,
            'apellidos' => $this->apellidos,
            'telefono' => $this->telefono,
            'email' => $this->email,
            'cargo' => $this->cargo,
        ]);

        $this->user->roles()->sync($this->selectedRoles);

        return redirect()->route('auth.index')->with('success', 'Usuario actualizado exitosamente');
    }

    public function render(): mixed
    {
        return view('livewire.auth.edit', ['user' => $this->user]);
    }
}; ?>

<div class="max-w-6xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-lg space-y-6">
    <h2 class="text-2xl font-bold text-center text-zinc-800 dark:text-white">Editar Usuario</h2>
    <hr class="border-gray-300 dark:border-zinc-700">

    <form wire:submit.prevent="updateUser" enctype="multipart/form-data">
        <h3 class="text-lg font-semibold text-zinc-700 dark:text-zinc-200 mb-4">Datos Personales</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-input-field name="nombres" label="Nombres" type="text" model="nombres" />

            <x-input-field name="apellidos" label="Apellidos" type="text" model="apellidos" />

            <x-input-field name="telefono" label="Teléfono" type="text" model="telefono" />

            <x-input-field name="email" label="Email" type="email" model="email" />

            <x-input-field name="cargo" label="Cargo" type="text" model="cargo" />
        </div>

        <hr class="my-6 border-gray-300 dark:border-zinc-700">

        <h3 class="text-lg font-semibold text-zinc-700 dark:text-zinc-200 mb-4">Asignar Roles</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach ($roles as $role)
                <label class="flex items-center space-x-2 p-2 rounded hover:bg-zinc-100 dark:hover:bg-zinc-700">
                    <input type="checkbox" wire:model="selectedRoles" value="{{ $role->id }}"
                        class="h-4 w-4 text-blue-600 border-gray-300 rounded dark:bg-zinc-800 dark:border-zinc-600">
                    <span class="text-gray-800 dark:text-gray-100">
                        {{ $role->name }}
                        @if (in_array($role->id, $selectedRoles))
                            <span class="text-xs text-gray-500 dark:text-gray-400">(Asignado)</span>
                        @endif
                    </span>
                </label>
            @endforeach
        </div>

        <div class="mt-2 flex justify-center md:grid-cols-2 gap-2">
            <flux:button type="submit" variant="primary" wire:loading.attr="disabled">
                <span wire:loading.remove>Actualizar Usuario</span>
                <span wire:loading>Actualizando...</span>
            </flux:button>

            {{-- generar boton para regresar a la lista de usuarios --}}
            <a class="button-blue" href="{{ route('auth.index') }}">Regresar</a>
        </div>
    </form>
</div>
