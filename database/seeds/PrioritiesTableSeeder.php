<?php

use Illuminate\Database\Seeder;

class PrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('priorities')->insert([
            ['name' => 'Fix now', 'sort' => 0, 'default' => false],
            ['name' => 'Fix if time', 'sort' => 1, 'default' => true],
            ['name' => 'Development', 'sort' => 2, 'default' => false],
            ['name' => 'Backlog', 'sort' => 3, 'default' => false],
        ]);
    }
}
