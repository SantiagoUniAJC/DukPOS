<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'direccion',
        'telefono',
        'email',
        'contacto',
        'responsable',
    ];

    public function ordenes()
    {
        return $this->hasMany(OrdenCompra::class, 'proveedor_id');
    }
}
