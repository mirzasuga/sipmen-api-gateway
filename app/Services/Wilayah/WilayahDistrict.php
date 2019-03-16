<?php
namespace App\Services\Wilayah;
use App\Services\Wilayah\ParentableTrait;

class WilayahDistrict extends WilayahService {
    use ParentableTrait;
    protected $type = 'districts';
}
