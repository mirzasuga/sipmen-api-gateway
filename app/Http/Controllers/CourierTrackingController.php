<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Events\CourierLocationUpdated;
use App\SuratJalan;

class CourierTrackingController extends Controller
{
    public function setLocation(Request $request) {
        $coords = [
            'lng' => $request->lng,
            'lat' => $request->lat
        ];
        Redis::set('location:surat_jalan_id-'.$request->surat_jalan_id.':'.$request->uuid.':coords', json_encode($coords));

        $suratJalanId = $request->surat_jalan_id;

        \broadcast(new CourierLocationUpdated($suratJalanId, $coords) );
        return response()->json([
            'success' => true,
            'message' => 'OK'
        ]);
    }
}
