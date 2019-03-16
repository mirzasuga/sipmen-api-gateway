<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\VendorDetail;

class Booking extends Model
{

    protected $fillable = [
        'receiver_province_id',
        'receiver_province_name',
        'receiver_regency_id',
        'receiver_regency_name',
        'receiver_district_id',
        'receiver_district_name',
        'receiver_village_id',
        'receiver_village_name',
        'receiver_street',
        'receiver_kodepos',
        'receiver_name',
        'receiver_phone',
        'package_name',
        'package_weight',
        'package_type',
        'package_is_fragile',
        'use_assurance',
        'jenis_pengiriman',
        'total_price',
        'tarif_price',
        'tarif_min_weight',
        'vendor_detail_id',
        'user_id',
        'vendor_branch_id',
        'vendor_tarif_id',
    ];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
    public function vendorDetail() {
        return $this->belongsTo(VendorDetail::class);
    }
}
