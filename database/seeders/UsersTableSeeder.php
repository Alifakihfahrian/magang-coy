<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'ruben',
            'email' => 'admin@example.com',
            'password' => Hash::make('123'),
            'username' => 'min', // jika kolom username ada
        ]);

        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'username' => 'regular_user', // jika kolom username ada
        ]);
    }
}
