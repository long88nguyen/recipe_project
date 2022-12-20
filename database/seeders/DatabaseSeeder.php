<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // \App\Models\Favourite::factory(300)->create();
        \App\Models\Rate::factory(5)->create();
        // \App\Models\Post::factory(20)->create();
        // \App\Models\Ingredient::factory(100)->create();
        // \App\Models\Category::factory(10)->create();
        // \App\Models\Direction::factory(100)->create();
        // \App\Models\PostImage::factory(100)->create();
        //  \App\Models\Member::factory(10)->create();
    }
}
