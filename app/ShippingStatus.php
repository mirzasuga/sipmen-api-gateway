<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Resi;

class ShippingStatus extends Model
{
    public function resi() {
        return $this->belongsToMany(Resi::class, 'resi_shipping_statuses', 'shipping_status_id', 'resi_id');
    }
}
