<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            'code' => 'CATEGORY_DELETE',
            'name' => 'category delete record',
            'router_name' => 'category.delete'
        ]);
    }
}
