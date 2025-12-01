<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemOrdenCompra extends Model
{
    protected $table = 'item_orden_compras';

    protected $fillable = [
        'orden_compra_id',
        'producto_id',
        'cantidad',
        'precio_costo',
        'subtotal',
    ];

    public function ordenCompra()
    {
        return $this->belongsTo(OrdenCompra::class, 'orden_compra_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
