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
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            MenuTableSeeder::class,
            WilayaTableSeeder::class,
            PeopleMenuSeeder::class,
            productSeeder::class,
            AccountTypesSeeder::class,
            ClientSeeder::class,
            SupplierSeeder::class,
            CommandSeeder::class,
            ProfitSeeder::class,
        ]);
    }
}
