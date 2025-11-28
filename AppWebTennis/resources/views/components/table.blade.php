@props([
    'items' => [],
    'columns' => [],
    'fields' => [],
    'hasActions' => false,
    'actions' => null,
    'editRoute' => null,
    'createRoute' => null,
    'showRoute' => null,
    'agendaRoute' => null,
])

<div class="overflow-x-auto rounded-xl shadow border border-gray-200 dark:border-zinc-700">
    <table class="min-w-full divide-y divide-zinc-200 dark:divide-zinc-700">
        <thead class="bg-zinc-50 dark:bg-zinc-900">
        <tr>
            @foreach ($columns as $column)
                <th class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                    {{ $column }}
                </th>
            @endforeach

            @if ($hasActions ?? false)
                <th class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">
                    Acciones
                </th>
            @endif
        </tr>
        </thead>

        <tbody class="bg-white dark:bg-zinc-800 divide-y divide-gray-200 dark:divide-zinc-700">
        @forelse ($items as $item)
            <tr>
                @foreach ($fields as $field)
                    @php
                        $value = is_callable($field) ? $field($item) : data_get($item, $field);
                    @endphp
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-zinc-800 dark:text-zinc-100">
                        @if($field === 'tarifario_creado')
                            {!! $value !!}
                        @elseif($field === 'precio')
                            ${{ number_format($value, 0, ',', '.') }} COP
                        @elseif($field === 'descuento')
                            {{ $value }} %
                        @else
                            {{ $value }}
                        @endif
                    </td>
                @endforeach

                {{-- Botón --}}
                @if ($hasActions ?? false)
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-zinc-800 dark:text-zinc-100">
                        <x-buttons-actions :item="$item" :editRoute="$editRoute" :agendaRoute="$agendaRoute" :createRoute="$createRoute" :showRoute="$showRoute"/>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="{{ count($fields) + ($hasActions ? 1 : 0)  }}"
                    class="px-6 py-4 text-center text-sm text-zinc-500 dark:text-zinc-400">
                    No hay registros disponibles.
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

@if (method_exists($items, 'links'))
    <div class="mt-4">
        {{ $items->links() }}
    </div>
@endif
