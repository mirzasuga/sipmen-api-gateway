<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Traits\ApiResponser;
use App\Resi;
use App\ShippingStatus;

use App\Events\ResiCreated;

class ResiController extends Controller
{
    use ApiResponser;

    public function create(Request $request) {
        $request->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required',
            'tarif_kg' => 'required',
            'berat_barang' => 'required',
            'total_biaya' => 'required',
            'is_fragile' => 'required',
        ]);

        $user = $request->user();
        $vendorDetail   = $user->vendorDetail;
        $shippingStatus = ShippingStatus::where('code', config('shipping_status.default') )->firstOrFail();
        $resi = Resi::create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'tarif_kg' => $request->tarif_kg,
            'berat_barang' => $request->berat_barang,
            'total_biaya' => $request->total_biaya,
            'created_by' => $user->id,
            'vendor_detail_id' => $vendorDetail->id,
            'last_status' =>  $shippingStatus->name.'-'. $vendorDetail->vendor_name
        ]);

        if ( !$resi ) {
            return $this->errorResponse([
                'success' => false,
                'message' => 'Gagal membuat pengiriman'
            ], 500);
        }

        $collection = collect($resi);
        $data = $collection->merge([
            'penerima' => $resi->penerima,
            'pengirim' => $resi->pengirim
        ]);

        $resiShippingStatus = [
            'note' => '',
            'updated_by' => $request->user()->id,
            'created_at' => date('Y-m-d h:i:s')
        ];
        event(new ResiCreated(
            $request->user(),
            $resi,
            $shippingStatus,
            $resiShippingStatus
        ));

        $data = [
            'success' => true,
            'message' => 'Berhasil membuat pengiriman',
            'data' => $data
        ];
        return $this->successResponse($data, 200);

    }

    public function list(Request $request) {
        $user = $request->user();
        $data = $user->vendorDetail
            ->pengirimans()
            ->with( ['penerima','pengirim','vendorDetail', 'otwSuratJalans'] )
            ->orderBy('id', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $data
        ]);

    }
}
