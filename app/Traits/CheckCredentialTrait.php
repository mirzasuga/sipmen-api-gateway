<?php

namespace App\Traits;

use Hash;

trait CheckCredentialTrait {


    public function ScopeCheckCredential($query, $email, $password) {
        
        return $query->where([
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        
    }

}