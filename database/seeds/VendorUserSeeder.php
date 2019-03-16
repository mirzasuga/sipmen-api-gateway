<?php

use Illuminate\Database\Seeder;
use App\Vendor;
use App\Models\Vendor\RoleVendor;
use App\VendorDetail;

class VendorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [

            /*** VENDOR OWNER */
            [
                'name' => 'Owner',
                'username' => 'owner',
                'email' => 'owner@jnt.com',
                'password' => bcrypt('secret'),
                'role' => 'vendor_owner'
            ],

            /*** VENDOR Office Counter */
            [
                'name' => 'Office Counter JNT',
                'username' => 'office',
                'email' => 'office@jnt.com',
                'password' => bcrypt('secret'),
                'role' => 'office_counter'
            ],
        ];
        foreach ($data as $vendor) {
            $str_role = $vendor['role'];
            unset($vendor['role']);
            $created = Vendor::create($vendor);
            $role = RoleVendor::where('name', $str_role)->first();
            echo "Vendor user created with ID: $created->id and Name: $created->name\n";
            $created->roles()->attach($role);
            echo "Vendor ID: $created->id Success Attached to Role: $role->name\n";

            $vendorDetail = VendorDetail::where('vendor_name', 'JNT INDONESIA')->first();
            $created->vendor_detail_id = $vendorDetail->id;
            $created->save();

            echo "Vendor User ID: $created->id success attached to Vendor Detail ID: $vendorDetail->id Name: $vendorDetail->vendor_name\n\n";
        }
    }
}
