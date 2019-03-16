<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Vehicle;
use App\Vendor;
use App\Resi;
use App\SuratJalanItems;


class SuratJalan extends Model
{
    protected $fillable = [
        'vehicle_id',
        'created_by',
        'courier_id',
        'type',
        'status'
    ];


    public function vehicle() {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function createdBy() {
        return $this->belongsTo(Vendor::class, 'created_by', 'id');
    }
    public function courier() {
        return $this->belongsTo(Vendor::class, 'courier_id', 'id');
    }
    public function resis() {
        return $this->belongsToMany(Resi::class, 'surat_jalan_items', 'surat_jalan_id', 'resi_id');
    }

    /**
     * SCOPE
     */
    public function scopeStatus($query, $status) {
        return $query->where('status', $status);
    }

    /**
     * Attribute
     */
    public function getTotalItemAttribute() {
        // TODO: Refactor add field in table 'total_item'
        return $this->resis->count();
    }
    public function getTotalMuatanAttribute() {
        // TODO: Refactor add field in table 'total_muatan'
        $total = 0;
        $this->resis->map( function ($resi) use (&$total) {
            return $total += $resi->berat_barang;
        });
        return $total;
    }
}
