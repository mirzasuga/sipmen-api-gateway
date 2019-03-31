<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;

use App\Vendor;

class RoleVendor extends Model
{
    protected $table = 'role_vendors';
    protected $fillable = [
        'name'
    ];

    public function vendors() {
        return $this->belongsToMany(Vendor::class, 'role_for_vendor', 'role_vendor_id', 'vendor_id');
    }

    public function scopeExists($query, $id) {
        $data = $query->where('id', $id)->first();

        if($data) {
            return true;
        }

        return false;
    }


    /**
     * STATIC FUNCTION
     */

    public static function getDefaultRole() {
        return self::firstOrCreate([
            'name' => config('vendor_rules.default_role')
        ]);
    }
}
