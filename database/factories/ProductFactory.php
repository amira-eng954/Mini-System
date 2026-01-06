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
    public function definition(): array
    {
        return [
            //
            'name'=>$this->faker->word(6),
            'sku'=>$this->faker->unique->name,
            'price'=>$this->faker->randomFloat(1,50,500),
            'qty'=>$this->faker->randomDigit(),
            'status'=> $this->faker->randomElement(['active','inactive']),
        ];
    }
}
