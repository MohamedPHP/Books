<?php

use Illuminate\Database\Seeder;

class SplizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('specializations')->truncate();
        $specializations = [
            [
                'name' => 'infomation systems',
            ],
            [
                'name' => 'computer scince',
            ],
        ];
        DB::table('specializations')->insert($specializations);
    }
}
