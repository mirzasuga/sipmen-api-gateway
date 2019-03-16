<?php

use Illuminate\Database\Seeder;
use App\VendorDetail;

class VendorDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'vendor_name' => 'JNT INDONESIA',
            'img_siup_url' => null,
            'img_tdp_url' => null,
            'img_akta_perusahaan_url' => null,
            'img_logo_url' => 'https://ecs7.tokopedia.net/img/cache/700/product-1/2016/10/2/11665663/11665663_1fbd1b8d-1dfa-46b9-8572-06d5d665a118.png'
        ];
        $vendorDetail = VendorDetail::create($data);
        echo "Vendor Detail Created with id $vendorDetail->id Name: $vendorDetail->vendor_name\n";
    }
}
