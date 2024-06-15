<?php

use Illuminate\Database\Seeder;

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
