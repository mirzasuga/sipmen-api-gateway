<?php

namespace App\Http\Controllers\Wilayah;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Wilayah\WilayahVillage;
use App\Traits\ApiResponser;

class VillageController extends Controller
{
    use ApiResponser;
    protected $wilayahVillage;

    public function __construct(WilayahVillage $wilayahVillage) {
        $this->wilayahVillage = $wilayahVillage;
    }

    public function all($districtId, Request $request) {

        $response = $this->wilayahVillage->obtainByParentId($districtId, $request->all() );
        $body = json_decode($response);

        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }

    }
}
