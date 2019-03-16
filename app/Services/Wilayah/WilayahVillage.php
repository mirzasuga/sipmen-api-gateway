<?php
namespace App\Services\Wilayah;
use App\Services\Wilayah\ParentableTrait;

class WilayahVillage extends WilayahService {
    use ParentableTrait;
    protected $type = 'villages';
}
