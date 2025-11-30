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
            <h2 class="text-2xl text-gray-500 dark:text-white">Inventario</h2>
            <p class="text-4xl font-bold mt-2 text-green-600">Pendiente definir</p>
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
