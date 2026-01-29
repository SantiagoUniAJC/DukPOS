<?php

use Livewire\Volt\Component;
use App\Models\Proveedor;
use App\Models\Compra;
use App\Models\CompraDetalle;
use App\Models\Sucursal;
use App\Models\InventarioSucursal;
use Illuminate\Support\Facades\DB;

new class extends Component {
    public $search = '';

    public function with(): array
    {
        return [
            'compras' => Compra::buscar($this->search, ['proveedor.razon_social'])
                ->with(['proveedor', 'sucursal', 'user', 'detalleCompra.variante'])
                ->where('estado', 'borrador')
                ->orderBy('id', 'desc')
                ->paginate(7),
        ];
    }

    public function confirmarCompra($compraId)
    {
        $mostrarWarning = false;

        DB::transaction(function () use ($compraId, &$mostrarWarning) {
            $compra = Compra::lockForUpdate()->findOrFail($compraId);

            if ($compra->estado !== 'borrador') {
                $mostrarWarning = true;
                return;
            }

            foreach ($compra->detalleCompra as $detalle) {
                $inventario = InventarioSucursal::firstOrCreate(
                    [
                        'variante_id' => $detalle->variante_id,
                        'sucursal_id' => $compra->sucursal_id,
                    ],
                    ['stock_actual' => DB::raw('stock_actual + ' . $detalle->cantidad)],
                );

                // $inventario->increment('stock_actual', $detalle->cantidad);

                // Moviento de Inventario
                //       MovimientoInventario::create([
                //     'justificacion'   => 'Compra confirmada',
                //     'motivo'          => 'Ingreso por compra',
                //     'cantidad'        => $detalle->cantidad,
                //     'tipo_movimiento' => 'entrada',
                //     'compra_id'       => $compra->id,
                //     'variante_id'     => $detalle->variante_id,
                //     'sucursal_id'     => $compra->sucursal_id,
                //     'user_id'         => auth()->id(),
                // ]);

                $compra->update([
                    'estado' => 'confirmada',
                ]);

                return redirect()->route('negocio.proveedores.compras.index')->with('success', 'Compra confirmada exitosamente.');
            }
        });

        if ($mostrarWarning) {
            $this->dispatch('swal-warning', 'La compra fue confirmada previamente.');
            return;
        }
    }
}; ?>

<div>
    <div class="px-4 sm:px-6 lg:px-8">
        <x-slot name="header">
            <h1 class="text-2xl text-center font-semibold text-gray-900 dark:text-white">
                {{ __('Lista de Compras Registradas.') }}
            </h1>
            <br>
        </x-slot>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-center">
            <div class="w-full max-w-md mx-auto">
                <input wire:model.live="search"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-zinc-800 dark:text-white"
                    placeholder="Búsqueda por nombre" />
                <div wire:loading>
                    <span>Buscando Compra ......</span>
                </div>
            </div>
        </div>

        @if ($compras->count() == 0)
            <div class="mt-4">
                <h5>{{ $search }}!</h5>
                <p>No se encontraron registros con los criterios de búsqueda ingresados.</p>
            </div>
        @else
            <div class="w-full mt-4 overflow-x-auto">
                <x-table :items="$compras" :columns="[
                    'Fecha de Compra',
                    'Proveedor',
                    'Sucursal',
                    'Variante',
                    'Responsable',
                    'Total Compra',
                    'Estado',
                    //'Fecha de Creación',
                ]" :fields="[
                    'fecha_compra',
                    'proveedor.razon_social',
                    'sucursal.nombre',
                    fn($compra) => $compra->detalleCompra
                        ->map(function ($detalleCompra) {
                            return $detalleCompra->variante->sku . ' x ' . $detalleCompra->cantidad;
                        })
                        ->implode(' & '),
                    'user.nombres',
                    'total',
                    'estado',
                    //'created_at',
                ]" :hasActions="true" :canConfirm="fn ($compra) => $compra->estado === 'borrador'" />
            </div>
        @endif

        <div class="mt-4">
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    if (typeof Livewire !== 'undefined') {
                        Livewire.on('confirmarCompra', function(compraId) {
                            Swal.fire({
                                title: "¿Estás seguro que deseas realizar esta compra?",
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonText: "Sí",
                                cancelButtonText: "Cancelar"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    @this.call('confirmarCompra', compraId);
                                }
                            });
                        });
                    } else {
                        console.warn('Livewire no está definido aún. Script de confirmación omitido.');
                    }
                });
            </script>
            <script>
                document.addEventListener('livewire:init', () => {
                    Livewire.on('swal-warning', message => {
                        Swal.fire({
                            position: "center",
                            icon: "error",
                            title: message,
                            showConfirmButton: true,
                            timer: 5000
                        });
                    });
                });
            </script>
        </div>
    </div>
</div>
