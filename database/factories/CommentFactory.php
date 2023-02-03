<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'member_id' => random_int(1000,1002),
            'post_id' => random_int(1,3),
            'comment' => $this->faker->paragraph(1),
        ];
    }
}
