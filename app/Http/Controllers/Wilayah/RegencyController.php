<?php

namespace App\Http\Controllers\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Wilayah\WilayahRegency;
use App\Traits\ApiResponser;

class RegencyController extends Controller
{
    use ApiResponser;
    protected $wilayahRegency;

    public function __construct(WilayahRegency $wilayahRegency) {
        $this->wilayahRegency = $wilayahRegency;
    }

    public function all($provinceId, Request $request) {

        $response = $this->wilayahRegency->obtainByParentId($provinceId, $request->all());
        $body = json_decode($response);

        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }

    }
}
