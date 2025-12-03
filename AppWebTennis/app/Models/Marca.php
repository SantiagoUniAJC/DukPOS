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
}
