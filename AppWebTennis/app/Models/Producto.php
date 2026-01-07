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
        'nombre',
        'descripcion',
        'imagen',
        'marca_id',
        'categoria_id',
        'estado',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function getMarcaNombreAttribute()
    {
        return "{$this->marca->nombre} {$this->nombre}";
    }

}
