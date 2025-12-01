<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $fillable = [
        'sku', //El SKU identifica de manera única una variante del producto dentro de tu empresa.
        'nombre',
        'descripcion',
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
