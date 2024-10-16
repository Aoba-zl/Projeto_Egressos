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
                'name' => 'ADS',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => 'RH',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => 'COMEX',
                'type_formation' => 'Tecnólogo',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
