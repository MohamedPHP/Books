<?php

use Illuminate\Database\Seeder;

class CatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('categouries')->truncate();
        $categouries = [
            [
                'name' => 'infomations',
            ],
            [
                'name' => 'computers',
            ],
            [
                'name' => 'scince',
            ],
            [
                'name' => 'algorithms',
            ],
            [
                'name' => 'programming',
            ],
            [
                'name' => 'analysis',
            ],
            [
                'name' => 'data structure',
            ],
        ];
        DB::table('categouries')->insert($categouries);
    }
}
