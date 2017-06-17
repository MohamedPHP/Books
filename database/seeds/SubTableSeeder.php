<?php

use Illuminate\Database\Seeder;

class SubTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('subjects')->truncate();
        /*
        // `name`, `email`, `password`, `download_limit`, `address`, `phonenumber`,
        // `generated_id`, `type`, `level_id`, `specialization_id`
        */
        $s = [];
         for ($i = 1; $i < 15 ; $i++){
             $s[] = [
                 'name'                => 'Laravel' . $i,
                 'code'                => $i * rand(10, 20),
                 'level_id'            => rand(1, 4),
                 'specialization_id'   => rand(1, 2),
             ];
         }
        DB::table('subjects')->insert($s);
    }
}
