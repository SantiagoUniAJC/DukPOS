<?php

namespace App\Observers;

use App\Models\Sucursal;

class SucursalObserver
{
    /**
     * Creating a new Sucursal observer instance.
     */

    public function creating(Sucursal $sucursal): void
    {
        $prefijoEmpresa = config('empresa.codigo', 'CALI');
        $tipo = 'SUC';
        $ultimo = Sucursal::orderBy('id', 'desc')->first();

        $siguienteNumero = $ultimo ? intval(substr($ultimo->codigo, -3 )) + 1 : 1;

        $sucursal->codigo = sprintf('%s-%s-%03d', $prefijoEmpresa, $tipo, $siguienteNumero);
    }

    /**
     * Handle the Sucursal "created" event.
     */
    public function created(Sucursal $sucursal): void
    {
        //
    }

    /**
     * Handle the Sucursal "updated" event.
     */
    public function updated(Sucursal $sucursal): void
    {
        //
    }

    /**
     * Handle the Sucursal "deleted" event.
     */
    public function deleted(Sucursal $sucursal): void
    {
        //
    }

    /**
     * Handle the Sucursal "restored" event.
     */
    public function restored(Sucursal $sucursal): void
    {
        //
    }

    /**
     * Handle the Sucursal "force deleted" event.
     */
    public function forceDeleted(Sucursal $sucursal): void
    {
        //
    }
}
