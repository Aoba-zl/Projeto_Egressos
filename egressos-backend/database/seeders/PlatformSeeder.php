<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('platforms')->insert([
            [
                'name' => 'Facebook',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => 'Github',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => 'Instagram',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => 'Linkedin',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => 'Youtube',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => 'X',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => 'Email',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'name' => 'Outra',
                'created_at' => now(),
                'updated_at' => now(),
            ]            
        ]);
    }
}
