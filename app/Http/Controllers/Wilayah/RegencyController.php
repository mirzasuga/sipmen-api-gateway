<?php

namespace App\Http\Controllers\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Wilayah\RegencyService;
use App\Traits\ApiResponser;

class RegencyController extends Controller
{
    use ApiResponser;
    protected $regencyService;

    public function __construct(RegencyService $regencyService) {
        $this->regencyService = $regencyService;
    }

    public function all($provinceId, Request $request) {

        $response = $this->regencyService->obtainByParentId($provinceId, $request->all());
        $body = json_decode($response);

        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }

    }
}
