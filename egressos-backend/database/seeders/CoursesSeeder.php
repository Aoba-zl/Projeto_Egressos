<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
            [
                'name' => '[ADS] Análise e Desenvolvimento de Sistemas',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[COMEX] Comércio Exterior',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[DPP] Desenvolvimento de Produtos Plásticos',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[DSM] Desenvolvimento de Software Multiplataforma',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[LOG] Logística',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[RH] Gestão de Recursos Humanos',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[???] Gestão Empresarial',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[POLI] Polímeros',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
