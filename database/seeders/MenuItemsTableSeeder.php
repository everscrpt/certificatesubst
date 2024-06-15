<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table(config('menu.table_prefix').'menu_items')->insert([
            [
                'label' => 'Home',
                'link' => 'http://127.0.0.1:8000',
                'parent' => 0,
                'sort' => 0,
                'menu' => 1,
                'depth' => 0,
            ],
            [
                'label' => 'Page One',
                'link' => 'http://127.0.0.1:8000/page-one',
                'parent' => 0,
                'sort' => 1,
                'menu' => 1,
                'depth' => 0,
            ],
            [
                'label' => 'Page Two',
                'link' => 'http://127.0.0.1:8000/page-two',
                'parent' => 0,
                'sort' => 2,
                'menu' => 1,
                'depth' => 0,
            ],
            [
                'label' => 'Home',
                'link' => 'http://127.0.0.1:8000',
                'parent' => 0,
                'sort' => 0,
                'menu' => 2,
                'depth' => 0,
            ],
            [
                'label' => 'Page One',
                'link' => 'http://127.0.0.1:8000/page-one',
                'parent' => 0,
                'sort' => 1,
                'menu' => 2,
                'depth' => 0,
            ],
            [
                'label' => 'Page Two',
                'link' => 'http://127.0.0.1:8000/page-two',
                'parent' => 0,
                'sort' => 2,
                'menu' => 2,
                'depth' => 0,
            ],
        ]);
    }
}
