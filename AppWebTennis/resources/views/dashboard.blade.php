<x-layouts.app :title="__('Dashboard')">
    <div class="grid auto-rows-min gap-4 md:grid-cols-3">

        {{-- Usuarios Conectados --}}
        <div class="bg-white dark:bg-zinc-900 p-5 rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-xs text-left uppercase mb-3 font-semibold text-gray-900 dark:text-white">
                Usuarios conectados: <span class="font-bold mt-2 text-green-600">{{ $usuariosLogueados->count() }}</span>
            </h2>

            <table class="min-w-full text-sm text-center">
                <thead class="border-b border-neutral-700 text-gray-600 dark:text-gray-300">
                    <tr>
                        <th class="px-3 py-2 ">Nombres</th>
                        <th class="px-3 py-2">Cargo</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($usuariosLogueados as $user)
                        <tr class="border-b border-neutral-800">
                            <td class="px-3 py-2 text-white">{{ $user->nombres }} 1</td>
                            <td class="px-3 py-2 text-white">{{ $user->cargo }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-3 py-2 text-center text-gray-400">
                                Ningún usuario conectado.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="bg-white dark:bg-zinc-900 p-5 rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-2xl text-center text-gray-500 dark:text-white mb-4">
                Total Inventario : <span class="text-green-500">{{ $inventarioTotal }}</span>
            </h2>

            @foreach ($inventarioPorSucursal as $sucursal => $marcas)
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200 mb-2">
                        {{ $sucursal }}
                    </h3>

                    @foreach ($marcas as $marca => $productos)
                        <details class="mb-2 group">
                            <summary
                                class="cursor-pointer flex justify-between items-center text-sm font-medium text-gray-700 dark:text-gray-300">
                                <span>
                                    {{ $marca }}
                                    <span class="text-xs text-neutral-400">
                                        ({{ $productos->count() }})
                                    </span>
                                </span>

                                <span class="text-sm font-semibold text-neutral-300">
                                    {{ $productos->sum('stock_total') }}
                                </span>
                            </summary>

                            <ul class="mt-2 ml-4 space-y-1">
                                @foreach ($productos as $item)
                                    <li class="flex justify-between text-sm text-gray-600 dark:text-gray-300">
                                        <span class="text-neutral-400">
                                            {{ $item->producto }}
                                        </span>

                                        <span
                                            class="font-semibold {{ $item->stock_total < 5 ? 'text-red-400' : 'text-emerald-400' }}">
                                            {{ $item->stock_total }}
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </details>
                    @endforeach
                </div>
            @endforeach
        </div>



        <div class="bg-white dark:bg-zinc-900 p-5 rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-2xl text-gray-500 dark:text-white">Menu</h2>
            <p class="text-4xl font-bold mt-2 text-green-600">Pendiente definir</p>
        </div>

        <div class="bg-white dark:bg-zinc-900 p-5 rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-2xl text-gray-500 dark:text-white">Inventario</h2>
            <p class="text-4xl font-bold mt-2 text-green-600">Pendiente definir</p>
        </div>

        <div class="bg-white dark:bg-zinc-900 p-5 rounded-xl border border-neutral-200 dark:border-neutral-700">
            <h2 class="text-2xl text-gray-500 dark:text-white">Menu</h2>
            <p class="text-4xl font-bold mt-2 text-green-600">Pendiente definir</p>
        </div>

    </div>
</x-layouts.app>
