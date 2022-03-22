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
            'category_id' => rand(1,10),
            'name' => $this->faker->unique()->word(),
            'description' => $this->faker->text(20),
            'price' => rand(1,10),
            'qty' =>  rand(10,50),
            'image' => "no image",
            'slug' => $this->faker->unique()->word(),
        ];
    }
}

