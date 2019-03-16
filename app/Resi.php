<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\AddressBook;
use App\Vendor;
use App\VendorDetail;
use App\ShippingStatus;
use App\SuratJalan;
use App\SuratJalanItems;

class Resi extends Model
{
    protected $fillable = [
        'branch_id',
        'sender_id',
        'receiver_id',
        'created_by',
        'tarif_kg',
        'berat_barang',
        'total_biaya',
        'is_fragile',
        'last_status',
        'vendor_detail_id'
    ];

    public function penerima() {
        return $this->hasOne(AddressBook::class, 'id', 'receiver_id');
    }

    public function pengirim() {
        return $this->hasOne(AddressBook::class, 'id', 'sender_id');
    }

    public function vendor() {
        return $this->belongsTo(Vendor::class, 'created_by');
    }
    public function vendorDetail() {
        return $this->belongsTo(VendorDetail::class, 'vendor_detail_id');
    }

    public function shippingStatus() {
        return $this->belongsToMany(ShippingStatus::class, 'resi_shipping_statuses','resi_id', 'shipping_status_id');
    }
    public function suratJalans() {
        return $this->belongsToMany(SuratJalan::class, 'surat_jalan_items', 'resi_id', 'surat_jalan_id')
        ->using(SuratJalanItems::class);
    }
    public function otwSuratJalans() {
        return $this->belongsToMany(
            SuratJalan::class, 'surat_jalan_items', 'resi_id', 'surat_jalan_id'
        )->where('surat_jalans.status', '=', 'on the way')
        ->orderBy('created_at', 'desc')
        ->using(SuratJalanItems::class);
    }
}
