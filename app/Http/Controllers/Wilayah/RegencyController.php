<?php

namespace App\Http\Controllers\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\WilayahService;
use App\Traits\ApiResponser;

class RegencyController extends Controller
{
    use ApiResponser;
    protected $wilayahService;

    public function __construct(WilayahService $wilayahService) {
        $this->wilayahService = $wilayahService;
    }

    public function all($provinceId, Request $request) {

        $response = $this->wilayahService->obtainRegencies($provinceId, $request->all());
        $body = json_decode($response);

        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }

    }
}
