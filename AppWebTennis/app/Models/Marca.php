<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Buscar;

class Marca extends Model
{
    // Incluir el trait Buscar para agregar funcionalidad de búsqueda
    use Buscar;

    protected $table = 'marcas';

    protected $fillable = [
        'nombre',
        'proveedor_id',
        'estado',
        'creado_por',
        'actualizado_por',
    ];

    public function creado_por()
    {
        return $this->belongsTo(User::class, 'creado_por');
    }

    public function actualizado_por()
    {
        return $this->belongsTo(User::class, 'actualizado_por');
    }

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
