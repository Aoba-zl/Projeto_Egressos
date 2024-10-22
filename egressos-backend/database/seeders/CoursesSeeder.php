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
                'name' => '[DSM] Desenvolvimento de Software Multiplataforma',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]            
            ,[
                'name' => '[INFO] Informática com ênfase em Gestão de Negócios',
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
                'name' => '[DPP] Produção com ênfase em Plásticos',
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
                'name' => '[RH] Gestão de Recursos Humanos',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[LOG] Logística com ênfase em Transportes',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[LOG] Logística e Transportes',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => '[EMP] Gestão empresarial',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
