<?php

namespace App\Models;
use App\Traits\Buscar;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use Buscar;

    protected $fillable = [
        'variante_id',
        'sucursal_id',
        'stock_actual',
        'stock_minimo',
        'estado',
    ];

    /* =========================
     * Relaciones
     * ========================= */

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function variante()
    {
        return $this->belongsTo(Variante::class);
    }
}
