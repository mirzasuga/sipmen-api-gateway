<?php

namespace App\Services;

use App\Traits\ConsumesExternalApi;

class TWilayahService {

    use ConsumesExternalApi;

    public $baseUri;
    public $secret;

    public function __construct() {
        $this->baseUri = config('sipmen_service.wilayah.api_url');
        $this->secret = '';
    }

    public function obtainProvinces() {
        return $this->performRequest('GET', '/province/all');
    }

    public function obtainRegencies( $provinceId, $params = [] ) {
        return $this->performRequest('GET', "/regencies/$provinceId", $params);
    }

    public function obtainDistricts( $regencyId, $params = [] ) {
        return $this->performRequest('GET', "/districts/$regencyId", $params);
    }

    public function obtainVillages( $districtId, $params = [] ) {
        return $this->performRequest('GET', "/villages/$districtId", $params);
    }

    public function obtainBranches()
    {

        return $this->performRequest('GET', '/all');

    }

    public function obtainCreateBranch( $data ) {
        return $this->performRequest('POST', '/create', $data);
    }

    public function obtainVendorBranches($vendorId) {

        return $this->performRequest('GET',"/vendor/$vendorId");

    }

    public function obtainSearchProvinceBy($data) {

        $params = [];
        foreach($data as $key => $val) {
            $params[] = "$key=$val";
        }
        $params = join("&", $params);

        return $this->performRequest('GET', "/province/search/by?$params");

    }

    public function obtainSearchDistrictBy($data) {

        $params = [];
        foreach($data as $key => $val) {
            $params[] = "$key=$val";
        }
        $params = join("&", $params);

        return $this->performRequest('GET', "/district/search/by?$params");

    }


}


interface IWilayahService {
    public function obtainAll();
}

trait Parentable {

    use ConsumesExternalApi;

    public function obtainByParentId($parentId) {
        $type = $this->type;
        return $this->performRequest('GET', "/$type/$parentId");
    }

}

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
}

class WilayahProvince extends WilayahService {
    protected $type = 'province';
}

class WilayahRegency extends WilayahService {
    use Parentable;
    protected $type = 'regencies';
}
