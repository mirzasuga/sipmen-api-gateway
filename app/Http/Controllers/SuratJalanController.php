<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SuratJalan;
use App\ShippingStatus;
use App\Resi;
use Log;
use App\Events\ResiAttachedToSuratJalan;
use App\Events\SuratJalanOnTheWayWarehouse;
use App\Events\ShippingStatusUpdated;

class SuratJalanController extends Controller
{
    public function create(Request $request) {
        $request->validate([
            'vehicle_id' => 'required',
            'packets' => 'required'
        ]);

        $defaultShippingStatus = 'SRT-WRH';
        $defaultType = 'gudang';
        $defaultStatus = 'idle';



        $user = $request->user();

        $shippingStatus = ShippingStatus::where('code', $defaultShippingStatus)->firstOrFail();

        $suratJalan = SuratJalan::create([
            'vehicle_id' => $request->vehicle_id,
            'created_by' => $user->id,
            'type' => $defaultType,
            'status' => $defaultStatus
        ]);

        foreach ( json_decode($request->packets) as $packet) {
            $resi = Resi::find($packet->id);

            if($resi) {

                $suratJalan->resis()->attach($resi);
                event(
                    new ResiAttachedToSuratJalan( $suratJalan, $resi, $shippingStatus, $user )
                );

            } else {

                $packetId = $packet['id'];
                Log::warning("RESI NOT FOUND WHEN ATTACHING TO SURAT JALAN| surat_jalan_id: ".$suratJalan->id." RESI ID: $packetId");

            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Berhasil membuat surat jalan',
            'data' => $suratJalan
        ]);
    }

    public function list(Request $request) {

        $suratJalans = SuratJalan::with([
            'createdBy',
            'courier',
            'vehicle',
            'resis'
        ])->paginate(5);
        $collections = [];

        foreach($suratJalans as $item) {
            // TODO: refactor this, should add new field in table 'total_item' and 'total_muatan'
            $collection = collect($item);
            $collection->put('total_item', $item->totalItem);
            $collection->put('total_muatan', $item->totalMuatan);
            $collections[] = $collection;
        }


        return response()->json([
            'success' => true,
            'message' => 'OK',
            'data' => $collections
        ]);

    }

    public function onTheWay(Request $request) {
        $request->validate([
            'surat_jalan_id' => 'required',
            'shipping_status' => 'required',
        ]);

        $suratJalan = SuratJalan::with(['resis','courier'])->findOrFail($request->surat_jalan_id);

        $shippingStatus = ShippingStatus::where('code', $request->shipping_status)->firstOrFail();

        $suratJalan->status = 'on the way';
        $suratJalan->courier_id = $request->user()->id;

        if ( !$suratJalan->save() ) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memulai perjalanan'
            ], 500);
        }

        event( new SuratJalanOnTheWayWarehouse(
                $suratJalan,
                $suratJalan->resis,
                $shippingStatus,
                $request->user()
            )
        );

        return response()->json([
            'success' => true,
            'message' => 'Berhasil memulai perjalanan',
            'data' => $suratJalan
        ]);

    }
}
