<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeedbackTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('feedback')->insert([
            [
                'id_profile' => 26,
                'comment' => 'Great work environment, learned a lot!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_profile' => 27,
                'comment' => 'Challenging projects, excellent team.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,
            [
                'id_profile' => 28,
                'comment' => 'Challenging projects, excellent team.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,
            [
                'id_profile' => 29,
                'comment' => 'Challenging projects, excellent team.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
