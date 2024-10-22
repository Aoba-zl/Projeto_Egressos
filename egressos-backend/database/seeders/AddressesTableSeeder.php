<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('addresses')->insert([
            [
                'cep' => '00000000',
                'num_porta' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'cep' => '03694000',
                'num_porta' => '2983',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'cep' => '01101010',
                'num_porta' => '615',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'cep' => '19910206',
                'num_porta' => '1400',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'cep' => '05508220',
                'num_porta' => '374',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'cep' => '18013280',
                'num_porta' => '2015',
                'created_at' => now(),
                'updated_at' => now(),
            ]
            ,[
                'cep' => '01311000',
                'num_porta' => '900',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
