<?php

namespace App\Models;
use App\Traits\Buscar;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use Buscar;

    protected $table = 'proveedores';

    protected $fillable = [
        'razon_social',
        'nit',
        'direccion',
        'telefono',
        'email',
        'contacto',
        'estado',
    ];

    public function ordenes()
    {
        return $this->hasMany(OrdenCompra::class, 'proveedor_id');
    }
}
