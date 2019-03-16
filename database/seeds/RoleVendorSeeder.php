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
        '1', 'Vendor Owner', 'vendor_owner', '2019-01-19 08:30:09', '2019-01-19 08:30:09'
        '2', 'Office Counter', 'office_counter', '2019-01-19 08:30:09', '2019-01-19 08:30:09'
        '3', 'Customer', 'customer', '2019-01-19 08:30:09', '2019-01-19 08:30:09'
        '4', 'Staff Warehouse', 'staff_warehouse', '2019-01-19 08:30:09', '2019-01-19 08:30:09'
        '5', 'Staff Courier', 'staff_courier', '2019-01-19 08:30:09', '2019-01-19 08:30:09'

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
