<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShippingStatus;
use App\Resi;

use App\Events\ShippingStatusUpdated;
use App\Events\QueueShippingStatus;
use Log;
class ShippingStatusController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'shipping_status_code' => 'required',
            'resi_id' => 'required',
        ]);

        $shippingStatus = ShippingStatus::where('code', $request->shipping_status_code)->firstOrFail();
        $resi = Resi::with(['pengirim','penerima'])->findOrFail($request->resi_id);

        $user = $request->user();

        /**Create new history status of resi */
        $resi->shippingStatus()->attach($shippingStatus, [
            'updated_by' => $user->id,
            'note' => '',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        /**Update last_status attribute in resis table */
        $resi->last_status = $shippingStatus->name.'-'.$user->vendorDetail->name;
        $resi->save();

        /**dispatch event bahwa resi telah diupdate statusnya */
        event(new ShippingStatusUpdated( $resi, $shippingStatus ) );

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Melakukan Update Status Pengiriman',
            'data' => $resi
        ]);
    }

    public function list(Request $request, $resiId) {
        $resi = Resi::findOrFail($resiId);
        $data = $resi->shippingStatus()->withPivot(['created_at'])->orderBy('resi_shipping_statuses.id', 'desc')->get();
        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $data
        ]);

    }

    public function bulk(Request $request) {
        $request->validate([
            'resis' => 'required',
            'shipping_status_code' => 'required'
        ]);
        $shippingStatusCode = $request->shipping_status_code;
        $staff = $request->user();
        $collections = json_decode($request->resis);

        foreach($collections as $resi) {
            event(
                new QueueShippingStatus (
                    $resi->id, $shippingStatusCode, $staff
                )
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Melakukan Update Status Pengiriman'
        ]);
    }
}
