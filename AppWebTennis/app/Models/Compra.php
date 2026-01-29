<?php

namespace App\Models;
use App\Traits\Buscar;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use Buscar;

    protected $table = 'compras';

    protected $fillable = [
        'id',
        'fecha_compra',
        'total',
        'estado',
        'observaciones',
        'proveedor_id',
        'sucursal_id',
        'user_id',
    ];

    public function detalleCompra()
    {
        return $this->hasMany(CompraDetalle::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
