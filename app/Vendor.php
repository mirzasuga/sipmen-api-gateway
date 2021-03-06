<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Traits\CheckCredentialTrait as CheckCredential;

use App\Models\Vendor\RoleVendor as Role;
use App\VendorDetail;
use App\Resi;

use App\Mail\VendorVerificationMail;
use Mail;
use Illuminate\Support\Facades\Redis;

class Vendor extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable, CheckCredential;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'mobile_phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_for_vendor', 'vendor_id', 'role_vendor_id');
    }

    public function vendorDetail() {
        return $this->belongsTo(VendorDetail::class, 'vendor_detail_id');
    }
    public function pengirimans() {
        return $this->hasMany(Resi::class, 'created_by');
    }
    public function suratJalan() {
        return $this->hasMany(SuratJalan::class);
    }

    public function sendEmailVerificationNotification() {

        $token = str_random(16);
        $expired = env('VENDOR_STAFF_VERIFICATION_EXPIRED') + 0;

        Redis::set('email-verification:vendorId-'.$this->id.':token-'.$token, $this->toJson(), 'EX', $expired);

        $LINK_CONFIRMATION = env('DASHBOARD_BASEURL', 'https://sipmen-backoffice.herokuapp.com/#/');
        $link = "$LINK_CONFIRMATION/#/verify-email/$this->id/$token";

        Mail::to($this->email)->send(new VendorVerificationMail($link));
    }

    // public function hasVerifiedEmail() {
    //     return $this->email_verified_at !== null;
    // }

    // public function ScopeCheckCredential($query, $email, $password) {
    //     return $query->where('email', $email)->where('password',
    //     \Hash::crypt($password));
    // }
}
