<?php
namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

use App\Resi;
use App\SuratJalan;

class SuratJalanItems extends Pivot {

    public function resi() {
        return $this->belongsTo(Resi::class);
    }
    public function suratJalan() {
        return $this->belongsTo(SuratJalan::class);
    }

}
