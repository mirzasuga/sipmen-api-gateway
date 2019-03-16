<?php

namespace App\Services;

use App\Traits\ConsumesExternalApi;

class GoogleMapsService {

    use ConsumesExternalApi;

    public $baseUri;
    public $secret;
    public $api_key;

    public function __construct() {
        $this->api_key = config('google.map.api_key');
        $this->baseUri = config('google.map.api_endpoint');
        $this->secret = '';
    }

    public function obtainMaps($params) {
        $url = "?key=$this->api_key";

        foreach($params as $key => $val) {
            $url .= "&$key=$val";
        }
        return $this->performRequest('GET',$url);
    }


}