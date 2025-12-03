<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Buscar;

class Producto extends Model
{
    use HasFactory, Buscar;

    protected $table = 'productos';

    protected $fillable = [
        'sku', //El SKU identifica de manera única una variante del producto dentro de tu empresa.
        'nombre',
        'descripcion',
        'precio_compra',
        'precio_venta',
        'stock_minimo',
        'stock_actual',
        'imagen',
        'actualizado_por',
        'marca_id',
        'categoria_id',
        'precio_base',
        'estado'
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

}
