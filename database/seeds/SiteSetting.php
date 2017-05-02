<?php

use Illuminate\Database\Seeder;

class SiteSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('site_settings')->truncate();
        $site_settings = [
            [
                'slug' => 'Site Name',
                'namesetting' => 'siteName',
                'value' => 'Books',
                'type' => 0,
            ],
            [
                'slug' => 'Desc',
                'namesetting' => 'siteDesc',
                'value' => 'goood goood goood goood goood goood goood goood goood goood goood goood goood goood goood goood goood goood goood goood goood goood ',
                'type' => 1,
            ],
             [
                 'slug' => 'facebook',
                 'namesetting' => 'facebook',
                 'value' => 'http://www.fb.com',
                 'type' => 0,
             ],
             [
                 'slug' => 'email',
                 'namesetting' => 'email',
                 'value' => 'mohamed@yahoo.com',
                 'type' => 0,
             ],
            [
                 'slug' => 'PH',
                 'namesetting' => 'sitePhone',
                 'value' => '01127946754',
                 'type' => 0,
             ],
             [
                 'slug' => 'address',
                 'namesetting' => 'address',
                 'value' => 'sdlkfsklbfwekfblwkefb',
                 'type' => 0,
             ],
             [
                 'slug' => 'copy',
                 'namesetting' => 'copyright',
                 'value' => 'Maohed Mohamed',
                 'type' => 0,
             ],
             [
                 'slug' => 'Welcome Message',
                 'namesetting' => 'welcomemessage',
                 'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                 'type' => 1,
             ],
             [
                 'slug' => 'Advantage 1 Name',
                 'namesetting' => 'Advantage_1_name',
                 'value' => 'Lorem ipsum dolor',
                 'type' => 0,
             ],
             [
                 'slug' => 'Advantage 1 Desc',
                 'namesetting' => 'Advantage_1_desc',
                 'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                 'type' => 1,
             ],
             [
                 'slug' => 'Advantage 2 Name',
                 'namesetting' => 'Advantage_2_name',
                 'value' => 'Lorem ipsum',
                 'type' => 0,
             ],
             [
                 'slug' => 'Advantage 2 Desc',
                 'namesetting' => 'Advantage_2_desc',
                 'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                 'type' => 1,
             ],
             [
                 'slug' => 'Advantage 3 Name',
                 'namesetting' => 'Advantage_3_name',
                 'value' => 'Lorem ipsum dolor',
                 'type' => 0,
             ],
             [
                 'slug' => 'Advantage 3 Desc',
                 'namesetting' => 'Advantage_3_desc',
                 'value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                 'type' => 1,
             ],
        ];
        DB::table('site_settings')->insert($site_settings);
    }
}
