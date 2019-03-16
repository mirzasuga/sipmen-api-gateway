<?php

namespace App\Services\Wilayah;
use App\Traits\ConsumesExternalApi;

class WilayahService implements IWilayahService {
    use ConsumesExternalApi;

    protected $basUri;
    protected $secret;
    protected $parentId;
    protected $type;

    public function __construct() {
        $this->baseUri = config('sipmen_service.wilayah.api_url');
    }

    public function obtainAll() {
        $type = $this->type;
        return $this->performRequest('GET', "/$type/all");
    }
    public function searchBy($params) {
        $params = [];
        foreach($data as $key => $val) {
            $params[] = "$key=$val";
        }
        $params = join("&", $params);
        $type = $this->type;
        return $this->performRequest('GET', "/$type/search/by?$params");
    }
}
