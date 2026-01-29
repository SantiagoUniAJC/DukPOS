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
        'precio_costo',
        'precio_venta',
        'producto_id',
        'estado',
    ];

    /* =========================
     * Relaciones
     * ========================= */

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }

    public function inventarioSucursales()
    {
        return $this->hasMany(InventarioSucursal::class);
    }

    public function compraDetalles()
    {
        return $this->hasMany(CompraDetalle::class);
    }
}
