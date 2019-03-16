<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\BranchService;
use App\Traits\ApiResponser;
use App\Vendor;


class BranchController extends Controller
{
    use ApiResponser;
    protected $branchService;

    public function __construct(BranchService $branchService) {
        $this->branchService = $branchService;
    }

    public function create(Request $request) {

        $response = $this->branchService->obtainCreateBranch( $request->all() );
        $body = json_decode($response);

        if ($body->status_code === 200 ) {
            return $this->successResponse( $response );
        } else {
            return $this->errorResponse( $body->message, $body->status_code );
        }
    }

    public function update(Request $request) {

    }

    public function delete($id) {

    }

    public function all(Request $request) {
        
        return $this->successResponse($this->branchService->obtainBranches());

    }

    public function vendorBranch($vendorId) {

        return $this->successResponse(
            $this->branchService->obtainVendorBranches($vendorId)
        );
        
    }
}
