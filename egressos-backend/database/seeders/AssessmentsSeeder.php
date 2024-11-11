<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AssessmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assessments')->insert([
            [
                'id_moderator_admi' => 2,
                'id_egress' => 3,
                'comment' => 'ok',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            , [
                'id_moderator_admi' => 2,
                'id_egress' => 4,
                'comment' => 'ok',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
