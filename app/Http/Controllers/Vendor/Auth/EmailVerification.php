<?php

namespace App\Http\Controllers\Vendor\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Redis;
use App\Vendor;

class EmailVerification extends Controller
{
    public function verify(Request $request) {
        $request->validate([
            'vendorId' => 'required',
            'token' => 'required'
        ]);
        $vendorId = $request->vendorId;
        $token = $request->token;
        $key = 'email-verification:vendorId-'.$vendorId.':token-'.$token;
        $vendor = Redis::get($key);

        if (!$vendor) {
            return response()->json([
                'message' => 'Token not found!',
                'status_code' => 404
            ], 404);
        }

        $vendor = json_decode($vendor);

        if ($vendorId+0 !== $vendor->id) {
            return response()->json([
                'message' => 'Invalid Token!',
                'status_code' => 401
            ], 404);
        }

        $vendor = Vendor::findOrFail($vendor->id);
        // $vendor->email_verified_at = date('Y-m-d H:i:s');
        $vendor->markEmailAsVerified();
        Redis::del($key);
        return response()->json([
            'message' => 'Berhasil melakukan verifikasi email',
            'status_code' => 200
        ]);

    }
}
