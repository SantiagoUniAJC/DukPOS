<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Nota: el modelo `VarianteProducto` usa el nombre de tabla `variante_producto`.
        Schema::create('variante_producto', function (Blueprint $table) {
            $table->id();
            $table->string('talla')->nullable();
            $table->string('color')->nullable();
            $table->string('codigo_barras')->nullable()->unique();
            $table->decimal('precio_costo', 10, 2)->default(0);
            $table->decimal('precio_venta', 10, 2)->default(0);
            $table->integer('stock')->default(0);
            $table->string('imagen_url')->nullable();
            $table->string('estado')->default('activo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variante_producto');
    }
};
