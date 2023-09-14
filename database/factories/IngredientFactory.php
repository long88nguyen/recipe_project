<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "post_id" => random_int(1,20),
            "name" => random_int(1,20) . " " . $this->faker->name(),
        ];
    }
}
