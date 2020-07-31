<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin',
            'password' => bcrypt('admin'),
            'is_admin' => 1
        ]);

        //User::create(['name' => 'admin' , 'email' => 'admin' , 'password' => bcrypt('admin'), 'is_admin' => 1]);
    }
}
