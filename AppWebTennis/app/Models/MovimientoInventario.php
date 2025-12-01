<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    protected $table = 'movimiento_inventarios';

    protected $fillable = [
        'producto_id',
        'sucursal_id',
        'variante_producto_id',
        'referencia_id',
        'cantidad',
        'tipo_movimiento', // 'entrada' o 'salida'
        'fecha_movimiento',
        'descripcion',
        'creado_por',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function varianteProducto()
    {
        return $this->belongsTo(VarianteProducto::class);
    }

    public function referencia()
    {
        return $this->morphTo();
    }

    public function variante()
    {
        return $this->belongsTo(VarianteProducto::class, 'variante_producto_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }
}
