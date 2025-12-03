<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Categoria;
use App\Models\Marca;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sku' => strtoupper($this->faker->bothify('####???')),
            'nombre' => $this->faker->randomElement([
                'Air Max 90',
                'Ultraboost',
                'Classic Leather',
                'Old Skool',
                'Gel-Kayano',
                'FuelCell Rebel',
                'Jordan 1 Low',
                'Forum Low'
            ]),
            'descripcion' => $this->faker->sentence(10),

            'categoria_id' => Categoria::inRandomOrder()->first()->id ?? Categoria::factory(),
            'marca_id' => Marca::inRandomOrder()->first()->id ?? Marca::factory(),

            // 'talla' => $this->faker->randomElement(['36', '37', '38', '39', '40', '41', '42', '43']),
            // 'color' => $this->faker->safeColorName(),

            'precio_compra' => $this->faker->randomFloat(2, 120000, 250000),
            'precio_venta' => function (array $attributes) {
                return $attributes['precio_compra'] * 1.35; // margen del 35%
            },

            'stock_minimo' => $this->faker->numberBetween(5, 15),

            'actualizado_por' => 1, // para pruebas 
        ];
    }
}
