<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';

    protected $fillable = [
        'codigo_compra',
        'fecha_compra',
        'subtotal',
        'impuesto',
        'total',
        'estado',
        'observaciones',
        'proveedor_id',
        'sucursal_id',
        'user_id',
    ];

}
