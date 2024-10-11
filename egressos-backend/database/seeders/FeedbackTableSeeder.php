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
                'id_profile' => 1,
                'comment' => 'Great work environment, learned a lot!',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_profile' => 2,
                'comment' => 'Challenging projects, excellent team.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,
            [
                'id_profile' => 3,
                'comment' => 'Challenging projects, excellent team.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,
            [
                'id_profile' => 4,
                'comment' => 'Challenging projects, excellent team.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
