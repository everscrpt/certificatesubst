<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuTableSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(config('menu.table_prefix').'menus')->insert([
            [
                'name' => 'Header Navigation',
            ],
            [
                'name' => 'Footer Navigation',
            ],
        ]);
    }
}
