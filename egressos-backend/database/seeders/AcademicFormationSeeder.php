<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicFormationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_formation')->insert([
            [
                'id_profile' => 1,
                'id_institution' => 1,
                'id_course' => 1,
                'begin_year' => 2019,
                'end_year' => 2024,
                'period' => "Matutino",
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'id_profile' => 2,
                'id_institution' => 1,
                'id_course' => 2,
                'begin_year' => 2020,
                'end_year' => 2024,
                'period' => "Matutino",
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'id_profile' => 3,
                'id_institution' => 1,
                'id_course' => 1,
                'begin_year' => 2020,
                'end_year' => 2024,
                'period' => "Matutino",
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'id_profile' => 4,
                'id_institution' => 1,
                'id_course' => 1,
                'begin_year' => 2020,
                'end_year' => 2024,
                'period' => "Matutino",
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
