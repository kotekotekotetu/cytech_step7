<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'company_id'   => fake()->numberBetween($min=1,$max=3),
            'product_name' => fake()->text(5),
            'price'        => fake()->numberBetween($min=80,$max=300),
            'stock'        => fake()->numberBetween($min=0,$max=1000),
            'comment'      => fake()->text(20),
            'created_at'   => date('Y-m-d H:i:s'),
            'updated_at'   => date('Y-m-d H:i:s'),
        ];
    }
}
