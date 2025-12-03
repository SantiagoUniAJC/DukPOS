<?php

namespace App\Traits;

// Trait para agregar funcionalidad de búsqueda a los modelos Eloquent
trait Buscar
{
    public function ScopeBuscar($query, $valor, $columnas = ['nombre'])
    {
        return $query->where(function ($q) use ($valor, $columnas) {
            foreach ($columnas as $columna) {
                $q->orWhere($columna, 'LIKE', "%{$valor}%");
            }
        });
    }
}