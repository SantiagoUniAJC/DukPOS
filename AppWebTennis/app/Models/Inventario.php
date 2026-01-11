<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $fillable = [
        'sucursal_id',
        'variante_producto_id',
        'stock_actual',
        'stock_minimo',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function varianteProducto()
    {
        return $this->belongsTo(VarianteProducto::class);
    }
}
