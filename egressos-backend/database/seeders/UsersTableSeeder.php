<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Isabela Daniela Brenda da Mota',
                'email' => 'idbm@example.com',
                'type_account' => 1,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pietra Jaqueline Laís Rocha',
                'email' => 'pietra@example.com',
                'type_account' => 2,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Kauê Gael Araújo',
                'email' => 'kgaraujo@example.com',
                'type_account' => 1,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pedro Fábio Pires',
                'email' => 'pedropires@example.com',
                'type_account' => 1,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Moe Smith',
                'email' => 'moe@example.com',
                'type_account' => 1,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
