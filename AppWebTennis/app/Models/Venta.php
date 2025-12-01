<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'producto_id',
        'cantidad',
        'precio_unitario',
        'total',
        'fecha_venta',
        'sucursal_id',
        'user_id',
        'metodo_pago',

    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function metodoPago()
    // {
    //     return $this->belongsTo(MetodoPago::class, 'metodo_pago');
    // }

    public function venta()
    {
        return $this->hasMany(Venta::class, 'venta_id');
    }
}
