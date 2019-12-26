<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Serdce SPb Admin',
            'email' => 'info@heart.com',
            'type'  => 'boss',
            'password' => bcrypt('secretsecret'),
        ]);

//        DB::table('widgets')->insert([
//            'description' => '',
//        ]);
    }
}
