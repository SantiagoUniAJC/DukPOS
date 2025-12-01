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
        // El modelo usa el nombre de tabla `movimientos_inventario`
        Schema::create('movimiento_inventarios', function (Blueprint $table) {
            $table->id();


            $table->integer('cantidad')->default(0);
            $table->string('tipo_movimiento');
            $table->dateTime('fecha_movimiento')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento_inventarios');
    }
};
