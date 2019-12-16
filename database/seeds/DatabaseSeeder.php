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
            'email' => 'info@serdcespb.ru',
            'type'  => 'supaBoss',
            'password' => bcrypt('qqq123'),
        ]);

//        DB::table('widgets')->insert([
//            'description' => '',
//        ]);
    }
}
