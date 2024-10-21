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
                'name' => '[ADM] Administração',
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
                'name' => '[CC] Ciências Contábeis',
                'type_formation' => 'Bacharelado',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
