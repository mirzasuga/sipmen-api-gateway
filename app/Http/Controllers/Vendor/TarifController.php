<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\TarifService;
use App\Traits\ApiResponser;

class TarifController extends Controller
{
    use ApiResponser;
    protected $tarifService;

    public function __construct(TarifService $tarifService) {
        $this->tarifService = $tarifService;
    }

    public function create(Request $request) {

        $response = $this->tarifService->obtainCreateTarif( $request->all() );
        $body = json_decode($response);

        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }
    }

    public function getByVendor(Request $request, $vendorDetailId) {

        $response = $this->tarifService->obtainGetByVendor( $vendorDetailId );
        $body = json_decode($response);
        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }

    }

    public function searchTarifNear(Request $request) {

        $response = $this->tarifService->obtainSearchNear( $request->all() );
        $body = json_decode($response);
        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }

    }
}
