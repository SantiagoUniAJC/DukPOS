<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompraDetalle extends Model
{
    protected $table = 'compra_detalles';

    protected $fillable = [
        'compra_id',
        'variante_id',
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public function variante()
    {
        return $this->belongsTo(Variante::class);
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }
}
