<?php

namespace App\Policies;

use App\Vendor;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\HandlesAuthorization;
use Auth;

class BranchPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(Vendor $vendor) {
        
        if ($vendor->vendor_detail_id == request()->vendor_detail_id) {
            return true;
        }
        return false;
    }

    public function getList(Vendor $vendor) {
        
        if ($vendor->vendor_detail_id == request()->vendor_detail_id) {
            return true;
        }
        return false;

    }
}
