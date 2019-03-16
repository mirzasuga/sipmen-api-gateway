<?php
namespace App\Services\Wilayah;
use App\Services\Wilayah\ParentableTrait;

class WilayahRegency extends WilayahService {
    use ParentableTrait;
    protected $type = 'regencies';
}
