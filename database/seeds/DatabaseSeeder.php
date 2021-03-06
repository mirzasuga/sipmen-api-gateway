<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call(RoleVendorSeeder::class);
        $this->call(VendorDetailSeeder::class);
        $this->call(VendorUserSeeder::class);
        $this->call(ShippingStatusSeeder::class);
    }
}
