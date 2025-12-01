<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVenta extends Model
{
    protected $table = 'item_ventas';

    protected $fillable = [
        'venta_id',
        'producto_id',
        'variante_producto_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
    
    public function varianteProducto()
    {
        return $this->belongsTo(VarianteProducto::class);
    }
}
