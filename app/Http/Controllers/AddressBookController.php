<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AddressBook;

class AddressBookController extends Controller
{

    private $perpage;

    public function __construct() {
        $this->perpage = 5;
    }

    public function search(Request $request) {

        $request->validate(['phone' => 'required|numeric']);

        $data = AddressBook::where('phone', $request->phone)->get();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    public function create(Request $request) {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'province_id' => 'required',
            'province_name' => 'required',
            'regency_id' => 'required',
            'regency_name' => 'required',
            'district_id' => 'required',
            'district_name' => 'required',
            'village_id' => 'required',
            'village_name' => 'required',
            'street' => 'required|min:30',
            'postal_code' => 'required|numeric|min:5',
        ]);
        $created = AddressBook::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'province_id' => $request->province_id,
            'province_name' => $request->province_name,
            'regency_id' => $request->regency_id,
            'regency_name' => $request->regency_name,
            'district_id' => $request->district_id,
            'district_name' => $request->district_name,
            'village_id' => $request->village_id,
            'village_name' => $request->village_name,
            'street' => $request->street,
            'postal_code' => $request->postal_code,
        ]);

        if (!$created) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan addressbook'
            ], 400);
        }

        // TODO: trigger event AddressBookCreated

        return response()->json([
            'success' => true,
            'message' => 'Berhasil menambahkan addressbook',
            'data' => $created
        ]);
    }
}
