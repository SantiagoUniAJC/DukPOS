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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();

            $table->integer('cantidad')->default(1);
            $table->decimal('precio_unitario', 10, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->dateTime('fecha_venta')->nullable();
            $table->string('metodo_pago')->nullable();

            // Relacion con ventas
            $table->unsignedBigInteger('venta_id');
            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
