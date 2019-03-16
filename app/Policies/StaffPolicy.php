<?php

namespace App\Policies;

use App\Vendor;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffPolicy
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

    public function getList(Vendor $vendor) {

        if ($vendor->vendor_detail_id == request()->route('vendorDetailId')) {
            return true;
        }
        return false;

    }

}
