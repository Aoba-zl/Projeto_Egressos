<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('institutions')->insert([
            [
                'name' => '[FATEC-ZL] Faculdade de Tecnologia da Zona Leste',
                'id_address' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[FATEC-SP] Faculdade de Tecnologia de São Paulo',
                'id_address' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[FATEC-OU] Faculdade de Tecnologia de Ourinhos',
                'id_address' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[USP] Universidade de São Paulo',
                'id_address' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[FATEC-SO] Faculdade de Tecnologia de Sorocaba',
                'id_address' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[UNIP-SP] Universidade Paulista',
                'id_address' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ]

            
        ]);
    }
}
