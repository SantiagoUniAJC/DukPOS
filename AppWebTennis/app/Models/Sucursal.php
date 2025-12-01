<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
    ];

    // public function empleados()
    // {
    //     return $this->hasMany(Empleado::class, 'sucursal_id');
    // }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class, 'inventario_id');
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class, 'venta_id');
    }
}
