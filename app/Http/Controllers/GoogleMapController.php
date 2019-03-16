<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleMapsService;
use App\Traits\ApiResponser;
use Log;

class GoogleMapController extends Controller
{
    use ApiResponser;
    protected $mapService;

    public function __construct(GoogleMapsService $mapService) {
        $this->mapService = $mapService;
    }

    public function getCordinate(Request $request) {

        try {
            
            return $this->successResponse(
                $this->mapService->obtainMaps( $request->all() )
            );

        } catch(\Exception $e) {

            Log::error($e->getMessage().'When requesting maps: '.json_encode($request->all()));
            return response()->json([
                'error' => $e->getMessage()
            ]);

        }

    }
}
