<?php

use Illuminate\Database\Seeder;

class CodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('codes')->truncate();
        /*
        // `name`, `email`, `password`, `download_limit`, `address`, `phonenumber`,
        // `generated_id`, `type`, `level_id`, `specialization_id`
        */
        $Codes = [
            [
                'code'       => 'MohamedZayed123123',
                'student_id' => '123123123',
            ],
            [
                'code'       => 'Mohamed',
                'student_id' => '19981998',
            ],
        ];
        DB::table('codes')->insert($Codes);
    }
}
