<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->insert([
            [
                'name' => 'Tech Solutions',
                'email' => 'info2@techsolutions.com',
                'phone' => '1234567890',
                'site' => 'www.techsolutions.com',
                'id_address' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Business Corp',
                'email' => 'contact2@businesscorp.com',
                'phone' => '0987654321',
                'site' => 'www.businesscorp.com',
                'id_address' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
