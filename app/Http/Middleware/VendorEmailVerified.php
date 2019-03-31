<?php

namespace App\Http\Middleware;

use Closure;
use App\Vendor;

class VendorEmailVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $vendor = Vendor::where('email', $request->username)->firstOrFail();

        return !$vendor->hasVerifiedEmail()
        ? abort(403, 'Email anda belum di verifikasi, silahkan cek email')
        : $next($request);
    }
}
