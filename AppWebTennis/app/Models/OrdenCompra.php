<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
    protected $table = 'orden_compras';

    protected $fillable = [
        'numero_orden',
        'fecha',
        'proveedor_id',
        'total',
        'estado',
        'observaciones',
        'creado_por',
        'proveedor_id',
        'sucursal_id',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'branch_id');
    }

    public function creador()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function items()
    {
        return $this->hasMany(ItemOrdenCompra::class, 'purchase_order_id');
    }
}
