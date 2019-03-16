<?php

namespace App\Http\Controllers\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\WilayahService;
use App\Traits\ApiResponser;

class DistrictController extends Controller
{
    use ApiResponser;
    protected $wilayahService;

    public function __construct(WilayahService $wilayahService) {
        $this->wilayahService = $wilayahService;
    }

    public function all($regencyId, Request $request) {

        $response = $this->wilayahService->obtainDistricts($regencyId, $request->all());
        $body = json_decode($response);

        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }

    }

    public function searchBy(Request $request) {
        $response = $this->wilayahService->obtainSearchDistrictBy(
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
