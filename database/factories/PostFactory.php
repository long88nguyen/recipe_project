<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "title" => $this->faker->text(10),
            "content" => $this->faker->text(20),
            "category_id" => random_int(1,10),
            "member_id" => random_int(1000,1005),
            "status" => 1,
            "time" => random_int(10,30),
        ];
    }
}
