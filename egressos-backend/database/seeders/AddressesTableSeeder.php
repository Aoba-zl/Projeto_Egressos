<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('addresses')->insert([
            [
                'cep' => '12345678',
                'num_porta' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'cep' => '87654321',
                'num_porta' => 200,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
