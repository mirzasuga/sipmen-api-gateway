<?php

namespace App\Http\Controllers\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Wilayah\WilayahDistrict;
use App\Traits\ApiResponser;

class DistrictController extends Controller
{
    use ApiResponser;
    protected $wilayahDistrict;

    public function __construct(WilayahDistrict $wilayahDistrict) {
        $this->wilayahDistrict = $wilayahDistrict;
    }

    public function all($regencyId, Request $request) {

        $response = $this->wilayahDistrict->obtainByParentId($regencyId, $request->all());
        $body = json_decode($response);

        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }

    }

    public function searchBy(Request $request) {
        $response = $this->wilayahDistrict->searchBy(
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
