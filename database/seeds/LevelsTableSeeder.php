<?php

use Illuminate\Database\Seeder;

class LevelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('levels')->truncate();
        $Levels = [
            [
                'number' => 1,
            ],
            [
                'number' => 2,
            ],
            [
                'number' => 3,
            ],
            [
                'number' => 4,
            ],
        ];
        DB::table('levels')->insert($Levels);
    }
}
