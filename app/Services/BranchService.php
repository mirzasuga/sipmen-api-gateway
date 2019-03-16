<?php

namespace App\Services;

use App\Traits\ConsumesExternalApi;

class BranchService {

    use ConsumesExternalApi;

    public $baseUri;
    public $secret;

    public function __construct() {
        $this->baseUri = config('sipmen_service.branch.api_url');
        $this->secret = '';
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


}