<?php

namespace App\Http\Controllers\Vendor\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Vendor;
use Auth;
use App\Events\VendorRegistered;

class RegisterController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:vendors'],
            'username' => ['required', 'string', 'max:70', 'unique:vendors'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    public function create(array $data) {
        return Vendor::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => $data['username'],
            'password' => Hash::make( $data['password'] )
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $vendor = $this->create( $request->all() );
        
        event( new VendorRegistered( $vendor ) );

        return response()->json([
            'OK' => true,
            'message' => 'Pendaftaran berhasil'
        ]);

        // event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        // return $this->registered($request, $user)
                        // ?: redirect($this->redirectPath());
    }
}
