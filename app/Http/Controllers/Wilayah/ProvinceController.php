<?php

namespace App\Http\Controllers\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Wilayah\WilayahProvince;
use App\Traits\ApiResponser;

class ProvinceController extends Controller
{
    use ApiResponser;
    protected $wilayahProvince;

    public function __construct(WilayahProvince $wilayahProvince) {
        $this->wilayahProvince = $wilayahProvince;
    }

    public function all(Request $request) {

        $response = $this->wilayahProvince->obtainAll();
        $body = json_decode($response);

        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }

    }

    public function searchBy(Request $request) {
        $response = $this->wilayahProvince->searchBy(
            $request->all()
        );
        $body = json_decode($response);

        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }
    }
}
