<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CodesTableSeeder::class);
        $this->call(LevelsTableSeeder::class);
        $this->call(SplizationsTableSeeder::class);
        $this->call(SubTableSeeder::class);
        $this->call(CatsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(SiteSetting::class);
    }
}
