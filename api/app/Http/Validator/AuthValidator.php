<?php

namespace App\Http\Validator;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthValidator 
{
    public function login($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:1',
            'password' => 'required|string|min:1',
        ]);
     
        
        if ($validator->fails()) {
            throw new Exception($validator->errors(), 422);
        }
    }

    public function register($request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|email|min:1',
            'password' => 'nullable|string|min:1',
            'name' => 'nullable|string|min:1',
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors(), 422);
        }
    }

}