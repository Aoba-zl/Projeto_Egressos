<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EgressesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('egresses')->insert([
            [
                'user_id' => 1,
                'cpf' => '12345678901',
                'phone' => '1234567890',
                'birthdate' => '1990-01-01',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'cpf' => '98765432100',
                'phone' => '0987654321',
                'birthdate' => '1992-02-02',
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
