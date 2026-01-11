<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Buscar;

class Sucursal extends Model
{
    use Buscar;
    protected $table = 'sucursales';

    protected $fillable = [
        'nombre',
        'codigo',
        'direccion',
        'telefono',
        'email',
        'estado',
        'user_id',
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }

    // public function ventas()
    // {
    //     return $this->hasMany(Venta::class, 'venta_id');
    // }
}
