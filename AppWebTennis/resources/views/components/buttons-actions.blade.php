@props([
    'item',
    'editRoute' => null,
    'createRoute' => null,
    'createLabel' => 'Crear',
    'showLabel' => 'Mostrar',
    'showRoute' => null,
    'canConfirm' => false,
])

<div class="flex justify-center gap-2">
    @if ($createRoute)
        <a href="{{ route($createRoute, $item->id) }}"
            class="px-3 py-1.5 bg-green-900 text-white rounded-md hover:bg-green-500 transition"
            title="{{ $createLabel ?? 'Crear' }}">
            {{ $createLabel ?? 'Crear' }}
        </a>
    @endif
    @if ($showRoute)
        <a href="{{ route($showRoute, $item->id) }}"
            class="px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-900 transition"
            title="{{ $showLabel ?? 'Mostrar' }}">
            {{ $showLabel ?? 'Mostrar' }}
        </a>
    @endif
    @if ($editRoute)
        <a href="{{ route($editRoute, $item->id) }}"
            class="px-3 py-1.5 bg-amber-600 text-white rounded-md hover:bg-amber-900 transition" title="Editar">
            Editar
        </a>
    @endif
    @if ($canConfirm)
        <button wire:click="$dispatch('confirmarCompra', {{ $item->id }})"
            class="px-3 py-1 bg-green-900 text-white rounded hover:bg-green-700 transition" title="Confirmar Compra">
            Confirmar
        </button>
    @endif

    <button wire:click="$dispatch('confirmdesactivar', {{ $item->id }})"
        class="px-3 py-1 bg-red-900 text-white rounded hover:bg-red-700 transition" title="Desactivar">
        Desactivar
    </button>
</div>
