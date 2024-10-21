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
        ]);
    }
}
