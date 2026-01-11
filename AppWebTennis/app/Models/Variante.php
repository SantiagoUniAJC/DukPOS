<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Buscar;

class Variante extends Model
{
    use Buscar;

    protected $table = 'variantes';

    protected $fillable = [
        'sku',
        'talla',
        'color',
        'codigo_barras',
        'descripcion',
        'precio',
        'stock',
        'producto_id',
        'sucursal_id',
        'estado',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class);
    }
}
