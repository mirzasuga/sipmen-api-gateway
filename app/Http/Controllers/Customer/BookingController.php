<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;

use App\Booking;
use App\Services\TarifService;

use Log;

class BookingController extends Controller
{
    use ApiResponser;

    public function create(Request $request) {

        $request->validate([
            'receiver_province_id' => 'required',
            'receiver_province_name' => 'required',
            'receiver_regency_id' => 'required',
            'receiver_regency_name' => 'required',
            'receiver_district_id' => 'required',
            'receiver_district_name' => 'required',
            'receiver_village_id' => 'required',
            'receiver_village_name' => 'required',
            'receiver_street' => 'required',
            'receiver_kodepos' => 'required',

            'receiver_name' => 'required',
            'receiver_phone' => 'required',

            'package_name' => 'required',
            'package_weight' => 'required',
            'package_type' => 'required',
            'package_is_fragile' => 'required',

            'use_assurance' => 'required',
            'jenis_pengiriman' => 'required',
            'vendor_tarif_id' => 'required',
        ]);
        $data = $request->all();

        $tarif = $data['Tarif'];
        unset($data['Tarif']);

        // TODO: Move to policy or middleware
        /**if ($request->package_weight < $tarif->min_kg) {
            return $this->errorResponse("Berat minimum pengiriman adalah: $tarif->min_kg KG", 422);
        } */

        $data['vendor_detail_id'] = $tarif->vendor_detail_id;
        $data['vendor_branch_id'] = $tarif->branch_id;
        $data['user_id'] = $request->user()->id;
        $data['price'] = $tarif->price;
        $data['total_price'] = $tarif->price * $data['package_weight'];
        $data['tarif_price'] = $tarif->price;
        $data['tarif_min_weight'] = $tarif->min_kg;
        $data['use_assurance'] = ($data['use_assurance'] === 'YA') ? 1 : 0;
        $data['package_is_fragile'] = ($data['package_is_fragile'] === 'YA') ? 1 : 0;

        $booking = Booking::create($data);

        if (!$booking) {
            return $this->errorResponse('Proses booking gagal, silahkan coba kembali', 500);
        }

        return response()->json([
            'message' => 'Berhasil membuat booking',
            'data' => $booking
        ]);

    }

    public function all(Request $request) {

        $bookings = Booking::orderBy('created_at', 'desc')
        ->where('user_id', $request->user()->id)
        ->with('vendorDetail')->paginate(5);
        return $this->successResponse([
            'OK' => true,
            'data' => $bookings
            // $request->user()->bookings()->with('vendorDetail')->paginate(5)
        ]);
    }
}
