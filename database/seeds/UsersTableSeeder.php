<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
        /*
        // `name`, `email`, `password`, `download_limit`, `address`, `phonenumber`,
        // `generated_id`, `type`, `level_id`, `specialization_id`
        */
        $Users = [
            [
                'name'                => 'admin',
                'email'               => 'admin@yahoo.com',
                'password'            =>  bcrypt('123123'),
                'address'             => 'admin admin',
                'phonenumber'         => '123123123',
                'student_id'          => '123123123',
                'type'                => 3,
                'level_id'            => 4,
                'specialization_id'   => 1,
                'code_id'   => 1,
            ],
        ];
        DB::table('users')->insert($Users);
    }
}
