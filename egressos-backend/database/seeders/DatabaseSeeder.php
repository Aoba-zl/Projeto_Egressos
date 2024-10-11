<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class
            ,AddressesTableSeeder::class
            // CompaniesTableSeeder::class,
            // EgressesTableSeeder::class,
            // ProfessionalProfileTableSeeder::class,
            // FeedbackTableSeeder::class,
            ,PlatformSeeder::class
            ,InstitutionSeeder::class
            //  UsersTableSeeder::class,
            //  AddressesTableSeeder::class,
            //  CompaniesTableSeeder::class,
            //  EgressesTableSeeder::class,
            ,ProfessionalProfileTableSeeder::class
            ,FeedbackTableSeeder::class
        ]);
    }
}
