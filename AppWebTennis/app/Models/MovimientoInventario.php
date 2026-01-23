<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MovimientoInventario extends Model
{
    protected $table = 'movimiento_inventarios';

    protected $fillable = [
        'justificacion',+ // Explicación del movimiento
        'motivo', // Razón del movimiento
        'cantidad', 
        'tipo_movimiento',// 'entrada' o 'salida'
        'venta_id',
        'compra_id',
        'variante_id',
        'sucursal_id',
        'user_id',
    ];

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }

    public function variante()
    {
        return $this->belongsTo(Variante::class);
    }
    
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
