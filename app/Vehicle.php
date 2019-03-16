<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\VendorDetail;

class Vehicle extends Model
{
    protected $fillable = [
        'no_polisi',
        'merk',
        'type',
        'tahun_pembuatan',
        'url_photo',
        'vendor_detail_id'
    ];

    public function vendorDetail() {
        return $this->belongsTo(VendorDetail::class);
    }
}
