<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionalProfileTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('professional_profile')->insert([
            [
                'id_company' => 1,
                'id_egress' => 1,
                'initial_date' => '2020-01-01',
                'final_date' => null,
                'area' => 'Software Development',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_company' => 2,
                'id_egress' => 2,
                'initial_date' => '2021-01-01',
                'final_date' => '2023-01-01',
                'area' => 'Project Management',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
