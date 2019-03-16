<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Vehicle;

class VehicleController extends Controller
{
    public function create(Request $request) {

        $request->validate([
            'no_polisi' => 'required|unique:vehicles',
            'merk' => 'required',
            'type' => 'required',
            'tahun_pembuatan' => 'required',
            'vendor_detail_id' => 'required'
        ]);
        
        $data = $request->all();
        $vehicle = Vehicle::create( $data );

        return response()->json([
            'data' => $data,
            'message' => 'Success',
            'status_code' => 200
        ]);

    }

    public function list($vendorDetailId) {

        $data = Vehicle::where('vendor_detail_id', $vendorDetailId)->get();

        return response()->json([
            'data' => $data,
            'message' => 'Success',
            'status_code' => 200
        ]);

    }
}
