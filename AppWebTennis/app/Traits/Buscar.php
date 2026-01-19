<?php

namespace App\Traits;

// Trait para agregar funcionalidad de búsqueda a los modelos Eloquent
trait Buscar
{
    public function ScopeBuscar($query, $valor, $columnas = ['nombre'])
    {
        return $query->where(function ($q) use ($valor, $columnas) {
            foreach ($columnas as $columna) {
                // Si la columna contiene ".", significa relación
                if (str_contains($columna, '.')) {
                    [$relacion, $campo] = explode('.', $columna);

                    $q->orWhereHas($relacion, function ($q2) use ($campo, $valor) {
                        $q2->where($campo, 'LIKE', "%{$valor}%");
                    });
                } else {
                    $q->orWhere($columna, 'LIKE', "%{$valor}%");
                }
            }
        });
    }
}
