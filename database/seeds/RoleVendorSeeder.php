<?php

use Illuminate\Database\Seeder;

use App\Models\Vendor\RoleVendor;

class RoleVendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'vendor_owner'],
            ['name' => 'office_counter'],
            ['name' => 'customer'],
        ];
        foreach ($data as $role) {
            $created = RoleVendor::create($role);
            echo "Role created ID: $created->id Name: $created->name\n";
        }
    }
}
