<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Vendor;
use App\Resi;

class VendorDetail extends Model
{
    protected $fillable = [
        'vendor_name',
        'img_siup_url',
        'img_tdp_url',
        'img_akta_perusahaan_url',
        'img_logo_url'
    ];

    protected $hidden = [
        'img_siup_url',
        'img_tdp_url',
        'img_akta_perusahaan_url'
    ];

    public function vendorUsers() {
        return $this->hasMany(Vendor::class, 'vendor_detail_id');
    }
    public function pengirimans() {
        return $this->hasMany(Resi::class, 'vendor_detail_id');
    }
}
