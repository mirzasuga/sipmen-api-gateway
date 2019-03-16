<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Vendor\RoleVendor;

class RoleController extends Controller
{
    public function list() {

        $data = RoleVendor::get();
        
        return response()->json([
            'data' => $data,
            'message' => 'Success',
            'status_code' => 200
        ]);

    }
}
