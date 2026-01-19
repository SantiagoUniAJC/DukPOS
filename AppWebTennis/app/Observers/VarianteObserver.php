<?php

namespace App\Observers;

use App\Models\Variante;

class VarianteObserver
{

    // Método para abreviar la marca/modelo a 2 letras
    private function abreviarMarca(string $marca, String $producto): string
    {
        $marca = preg_replace('/[^A-Z]/', '', $marca);
        $producto = preg_replace('/[^A-Z]/', '', $producto);
        return (substr($marca, 0, 2) ?: 'XX') . 
                (substr($producto, 0, 2) ?: 'XX');
    }

    // Método para abreviar color a 1 letra según catálogo
    private function abreviarColor(string $color): string
    {
        $mapaColores = [
            'NEGRO' => 'N',
            'BLANCO' => 'B',
            'MARRÓN' => 'M',
            'MARRON' => 'M',
            'AZUL' => 'A',
            'ROJO' => 'R',
            'GRIS' => 'G',
            'VERDE' => 'V',
        ];

        return $mapaColores[$color] ?? 'X';
    }

    /**
     * Codigo de barras generado automaticamente al crear la variante
     */
    private function generarCodigoBarras(): string
    {
        return str_pad(
            now()->format('YmdHis') . rand(0, 9),
            13,
            '0',
            STR_PAD_RIGHT
        );
    }


    /**
     * Creating a new Variante observer instance.
     * el codigo esta compuesto por marca-talla-color
     */
    public function creating(Variante $variante): void
    {
        // abreviatura de marca (2 letras)
        $marca = strtoupper($variante->producto->marca->nombre ?? 'XX');
        $producto = strtoupper($variante->producto->nombre ?? 'XX');
        $prefijoMarca = $this->abreviarMarca($marca, $producto);

        // 2. Obtener talla tal cual
        $talla = $variante->talla;

        // 3. Obtener abreviatura de color (1 letra)
        $color = strtoupper($variante->color ?? 'X');
        $prefijoColor = $this->abreviarColor($color);

        // 4. Construir código concatenando
        $sku = $prefijoMarca . $talla . $prefijoColor;

        // 5. Asignar al modelo
        $variante->sku = $sku;

        // Generar código de barras si no está establecido
        if (empty($variante->codigo_barras)) {
            $variante->codigo_barras = $this->generarCodigoBarras();
        }
    }

    /**
     * Handle the Variante "created" event.
     */
    public function created(Variante $variante): void
    {
        //
    }

    /**
     * Handle the Variante "updated" event.
     */
    public function updated(Variante $variante): void
    {
        //
    }

    /**
     * Handle the Variante "deleted" event.
     */
    public function deleted(Variante $variante): void
    {
        //
    }

    /**
     * Handle the Variante "restored" event.
     */
    public function restored(Variante $variante): void
    {
        //
    }

    /**
     * Handle the Variante "force deleted" event.
     */
    public function forceDeleted(Variante $variante): void
    {
        //
    }
}
