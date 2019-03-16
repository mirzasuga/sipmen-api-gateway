<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Vendor;
use App\VendorDetail;
use App\Models\Vendor\RoleVendor;
use App\Events\VendorStaffCreated;


class VendorStaffController extends Controller
{
    public function __construct() {}

    public function create(Request $request, $vendorDetailId) {

        $request->validate([
            'name' => 'required',
            'username' => 'required|unique:vendors',
            'email' => 'required|unique:vendors',
            'role_vendor_id' => 'required'
        ]);

        $data = $request->all();
        $vendor = Vendor::create($data);
        $vendorDetail = VendorDetail::find($vendorDetailId);
        $role = RoleVendor::find($data['role_vendor_id']);

        event(new VendorStaffCreated($vendor, $role, $vendorDetail));

        return response()->json([
            'data' => $data,
            'message' => 'Success',
            'status_code' => 200
        ]);
    }

    public function setPassword(Request $request, $vendorId, $token) {

        $request->validate([
            'password' => 'required:min:6'
        ]);

        $vendor = Vendor::find($vendorId);

        $vendor->password = bcrypt($request->password);
        $vendor->save();

        return response()->json([
            'message' => 'Confirmation success',
            'status_code' => 200
        ]);
    }

    public function list(Request $request, $vendorDetailId) {

        $vendorDetail = VendorDetail::findOrFail($vendorDetailId);
        $staff = $vendorDetail->vendorUsers()->paginate(10);

        return response()->json([
            'data' => $staff,
            'message' => 'Success',
            'status_code' => 200
        ]);
    }
}
