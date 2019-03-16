<?php

namespace App\Services\Wilayah;
use App\Traits\ConsumesExternalApi;

trait ParentableTrait {

    // use ConsumesExternalApi;

    public function obtainByParentId($parentId) {
        $type = $this->type;
        return $this->performRequest('GET', "/$type/$parentId");
    }

}
