<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Bug', 'fa_icon' => 'fa-bug', 'default' => true],
            ['name' => 'Feature', 'fa_icon' => 'fa-lightbulb-o', 'default' => false],
        ]);
    }
}
