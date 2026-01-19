<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventarioSucursal extends Model
{
    protected $table = 'inventario_sucursales';

    protected $fillable = [
        'sucursal_id',
        'variante_id',
        'stock_actual',
        'stock_minimo',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function variante()
    {
        return $this->belongsTo(Variante::class);
    }
}