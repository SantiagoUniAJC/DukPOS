<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\Proveedor;
use App\Models\Sucursal;
use App\Models\Variante;
use App\Models\Compra;
use App\Models\CompraDetalle;
use Illuminate\Support\Facades\DB;

new class extends Component {
    use WithFileUploads;

    public $proveedor_nombre;
    public $proveedor_id;

    public $sucursal_id;
    public $sucursales = [];

    public $variantes = [];
    public $variante_id;

    public array $detalle = [];

    public $cantidad = 0;
    public $precio_unitario = 0;
    public $subtotal = 0;
    public $total = 0;
    public $observaciones;

    public $user_id;
    public $users = [];
    public $fecha_compra;

    public function mount(Proveedor $proveedor): void
    {
        $this->proveedor_id = $proveedor->id;
        $this->proveedor_nombre = $proveedor->razon_social;
        $this->sucursales = Sucursal::pluck('nombre', 'id')->toArray();
        $this->user_id = auth()->user()->id;
        $this->cargarVariantesPorProveedor();
    }

    public function cargarVariantesPorProveedor()
    {
        $this->variantes = Variante::whereHas('producto', function ($query) {
            $query->where('producto_id', $this->proveedor_id);
        })
            ->distinct()
            ->pluck('sku', 'id')
            ->toArray();
    }

    public function rules(): array
    {
        return [
            'proveedor_id' => ['required', 'exists:proveedores,id'],
            'sucursal_id' => ['required', 'exists:sucursales,id'],
            'variante_id' => ['required', 'exists:variantes,id'],
            'cantidad' => ['required', 'numeric', 'min:1'],
            'precio_unitario' => ['required', 'numeric', 'min:0'],
            'fecha_compra' => ['required', 'date'],
            'observaciones' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            '*.required' => 'Este campo es obligatorio.',
            '*.min' => 'El contenido es demasiado corto.',
            '*.max' => 'El contenido es demasiado largo.',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
            'sucursal_id.exists' => 'La sucursal seleccionada no es válida.',
            'variante_id.exists' => 'La variante seleccionada no es válida.',
            'fecha_compra.date' => 'La fecha de compra no es válida.',
            'cantidad.numeric' => 'La cantidad debe ser un número.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',
            'precio_unitario.numeric' => 'El precio unitario debe ser un número.',
            'precio_unitario.min' => 'El precio unitario no puede ser negativo.',
        ];
    }

    public function agregarDetalle()
    {
        if (!$this->variante_id || !$this->cantidad || !$this->precio_unitario) {
            return;
        }

        $variante = Variante::find($this->variante_id);

        // Evitar duplicados (sumar cantidad)
        foreach ($this->detalle as &$item) {
            if ($item['variante_id'] == $this->variante_id) {
                $item['cantidad'] += $this->cantidad;
                $item['subtotal'] = $item['cantidad'] * $item['precio_unitario'];
                $this->recalcularTotal();
                $this->resetCamposDetalle();
                return;
            }
        }

        $this->detalle[] = [
            'variante_id' => $variante->id,
            'sku' => $variante->sku,
            'cantidad' => $this->cantidad,
            'precio_unitario' => $this->precio_unitario,
            'subtotal' => $this->cantidad * $this->precio_unitario,
        ];

        $this->recalcularTotal();
    }

    public function eliminarDetalle($index)
    {
        unset($this->detalle[$index]);
        $this->detalle = array_values($this->detalle);
        $this->recalcularTotal();
    }

    public function recalcularTotal()
    {
        $this->subtotal = collect($this->detalle)->sum('subtotal');
        $this->total = $this->subtotal * 1.19;
    }

    public function resetCamposDetalle()
    {
        $this->variante_id = null;
        $this->cantidad = 1;
        $this->precio_unitario = 0;
    }

    public function comprarProducto()
    {
        $this->validate();

        $this->subtotal = $this->cantidad * $this->precio_unitario;
        //Calcular el total con impuesto del 19%
        $this->total = $this->subtotal * 1.19;

        if (empty($this->detalle)) {
            $this->dispatch('swal-warning', 'Debe agregar al menos una variante a la compra.');
            return;
        }

        DB::beginTransaction();
        try {
            // Guardar compra
            $compra = Compra::create([
                'fecha_compra' => $this->fecha_compra,
                'proveedor_id' => $this->proveedor_id,
                'sucursal_id' => $this->sucursal_id,
                'user_id' => $this->user_id,

                'total' => $this->total,
                'observaciones' => $this->observaciones,
            ]);

            // Guardar cada detalle
            foreach ($this->detalle as $item) {
                CompraDetalle::create([
                    'compra_id' => $compra->id,
                    'variante_id' => $item['variante_id'],
                    'cantidad' => $item['cantidad'],
                    'precio_unitario' => $item['precio_unitario'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            DB::commit();

            return redirect()->route('negocio.proveedores.compras.index')->with('success', 'Producto comprado exitosamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            report($e);

            $this->dispatch('swal-warning', 'Ocurrió un error al guardar la compra.');
        }
    }
}; ?>

<div>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold text-gray-900 dark:text-white text-center">
            {{ __('Formulario para la Compra de Productos.') }}
        </h1>
        <flux:separator class="mt-4 mb-4" /><br>
    </x-slot>
    <div class="max-w-7xl mx-auto p-6 bg-white dark:bg-zinc-900 rounded-lg shadow-md">
        <form wire:submit.prevent='comprarProducto' enctype="multipart/form-data">
            @csrf

            {{-- Compra --}}
            <div class="mb-4">
                <h2 class="text-2xl text-center font-semibold text-gray-800 dark:text-white">
                    {{ __('Compra de Productos') }}
                </h2>
                <flux:separator class="mt-2 mb-2" />
                <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-6">

                    <x-input-field name="fecha_compra" label="Fecha de Compra" type="date" model="fecha_compra" />

                    <x-input-field name="proveedor_nombre" label="Proveedor" model="proveedor_nombre" readonly />

                    {{-- Sucursal_id --}}
                    <x-select-field name="sucursal_id" label="Sucursal de Destino" model="sucursal_id" :options="$sucursales"
                        placeholder="Seleccione una sucursal" />
                </div>
            </div>

            {{-- Detalle de la Compra --}}
            <div class="mb-4">
                <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                    {{ __('Variantes del Producto') }}
                </h2>
                <flux:separator class="mt-2 mb-2" />
                <div class="grid grid-cols-1 md:grid-cols-3 xl:grid-cols-5 gap-6">

                    {{-- Variante Id --}}
                    <x-select-field name="variante_id" label="Codigo de Variante" type="number" :options="$variantes"
                        model="variante_id" placeholder="Seleccione una variante" />

                    <x-input-field name="cantidad" label="Cantidad" type="number" step="1" model="cantidad" />

                    <x-input-field name="precio_unitario" label="Precio Unitario" type="number" step="1"
                        model="precio_unitario" />

                    <x-input-field name="observaciones" label="Observaciones" type="text" model="observaciones" />

                </div>
                <div class="mt-2 flex justify-end">
                    <flux:button type="button" wire:click="agregarDetalle" variant="primary">
                        Agregar Variante
                    </flux:button>
                </div>

                {{-- @if (count($detalle)) --}}
                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">
                        Detalle de la Compra
                    </h3>

                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs uppercase bg-gray-100 dark:bg-zinc-800">
                            <tr>
                                <th>SKU</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                                <th>Subtotal</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalle as $index => $item)
                                <tr class="border-b dark:border-zinc-700">
                                    <td>{{ $item['sku'] }}</td>
                                    <td>{{ $item['cantidad'] }}</td>
                                    <td>{{ number_format($item['precio_unitario'], 0) }}</td>
                                    <td>{{ number_format($item['subtotal'], 0) }}</td>
                                    <td>
                                        <flux:button type="button" size="xs" variant="danger"
                                            wire:click="eliminarDetalle({{ $index }})">
                                            Quitar
                                        </flux:button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4 text-right text-lg font-semibold">
                        Subtotal: {{ number_format($subtotal, 0) }} <br>
                        Total (IVA): {{ number_format($total, 0) }}
                    </div>
                </div>
                {{-- @endif --}}

            </div>
            <div class="mt-6 flex justify-center">
                <flux:button type="submit" variant="primary">
                    Comprar
                </flux:button>
            </div>
        </form>
    </div>
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
