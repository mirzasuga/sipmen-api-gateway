<?php

namespace App\Http\Controllers\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\WilayahService;
use App\Traits\ApiResponser;

class ProvinceController extends Controller
{
    use ApiResponser;
    protected $wilayahService;

    public function __construct(WilayahService $wilayahService) {
        $this->wilayahService = $wilayahService;
    }

    public function all(Request $request) {

        $response = $this->wilayahService->obtainProvinces();
        $body = json_decode($response);

        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }

    }

    public function searchBy(Request $request) {
        $response = $this->wilayahService->obtainSearchProvinceBy(
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
