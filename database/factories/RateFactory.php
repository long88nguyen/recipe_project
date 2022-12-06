<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
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
            "member_id" =>random_int(1000,1005),
            "number_rating" => random_int(1,5),
        ];
    }
}
