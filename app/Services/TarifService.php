<?php

namespace App\Services;

use App\Traits\ConsumesExternalApi;

class TarifService
{
    use ConsumesExternalApi;

    public $baseUri;
    public $secret;

    public function __construct() {
        $this->baseUri = config('sipmen_service.tarif.api_url');
        $this->secret = '';
    }

    public function obtainCreateTarif( $data ) {
        return $this->performRequest('POST', '/create', $data);
    }

    public function obtainGetByVendor( $vendorDetailId ) {

        return $this->performRequest('GET', "/all/vendor/$vendorDetailId");

    }

    public function obtainFindTarifById ( $tarifId ) {
        return $this->performRequest('GET', "/find/$tarifId");
    }

    public function obtainSearchNear( $data ) {

        $query = [];
        foreach($data as $k => $v) {
            $query[] = "$k=$v";
        }
        $params = join("&", $query);

        return $this->performRequest('GET', "/get?$params");

    }
}
