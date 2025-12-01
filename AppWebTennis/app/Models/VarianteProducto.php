<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VarianteProducto extends Model
{
    protected $table = 'variante_producto';

    protected $fillable = [
        'producto_id',
        'talla',
        'color',
        'codigo_barras',
        'precio_costo',
        'precio_venta',
        'stock',
        'imagen_url',
        'estado'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function inventario()
    {
        return $this->hasMany(Inventario::class, 'variante_producto_id');
    }
}
