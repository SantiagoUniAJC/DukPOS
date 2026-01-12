<div>
    <flux:navbar.item icon="magnifying-glass" label="Buscar" wire:click="$set('isOpen', true)" />

    <flux:modal wire:model="isOpen" class="md:w-96">
        <div class="space-y-6">
            <flux:heading size="lg">
                Búsqueda por Código o Marca
            </flux:heading>

            <flux:input wire:model.live="search" placeholder="Buscar por SKU o Marca..." autofocus />

            <div class="mt-4 space-y-2">
                @if (strlen($search) >= 2)
                    @forelse ($this->results as $variante)
                        <a href="{{ route('dashboard', $variante) }}"
                            class="block rounded-md px-3 py-2 hover:bg-zinc-100 dark:hover:bg-zinc-800">
                            <div class="font-medium">
                                {{ $variante->sku }}
                            </div>
                            <div class="text-xs text-zinc-500">
                                <p>Referencia: {{ $variante->producto->nombre }}
                                    Talla: {{ $variante->talla }}
                                    Stock: {{ $variante->stock }}
                                    Sucursal: {{ $variante->sucursal->nombre }}</p>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-zinc-500">
                            Sin resultados
                        </p>
                    @endforelse
                @endif
            </div>
        </div>
    </flux:modal>
</div>
