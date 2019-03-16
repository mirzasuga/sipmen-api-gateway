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
            [
                'display' => 'Vendor Owner',
                'name' => 'vendor_owner'
            ],
            [
                'display' => 'Office Counter',
                'name' => 'office_counter'
            ],
            [
                'display' => 'Customer',
                'name' => 'customer'
            ],
            [
                'display' => 'Staff Warehouse',
                'name' => 'staff_warehouse'
            ],
            [
                'display' => 'Staff Courier',
                'name' => 'staff_courier'
            ],
        ];
        foreach ($data as $role) {
            $created = RoleVendor::create($role);
            echo "Role created ID: $created->id Name: $created->name\n";
        }
    }
}
