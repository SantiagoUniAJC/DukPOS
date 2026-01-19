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

    /* =========================
     * Relaciones
     * ========================= */

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function inventario()
    {
        return $this->hasMany(Inventario::class);
    }

    public function inventarioSucursales()
    {
        return $this->hasMany(InventarioSucursal::class);
    }
}
