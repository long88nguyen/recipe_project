<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DirectionFactory extends Factory
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
            "step" =>1,
            "description" => $this->faker->text(30),
        ];
    }
}
