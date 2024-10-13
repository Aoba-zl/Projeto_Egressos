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
        ]);
    }
}
