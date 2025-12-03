<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Buscar;

class Categoria extends Model
{
    use Buscar;

    protected $table = 'categorias';

    protected $fillable = ['nombre', 'descripcion', 'estado', 'actualizado_por'];
    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
}
