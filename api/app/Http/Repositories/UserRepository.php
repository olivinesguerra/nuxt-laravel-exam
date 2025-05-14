<?php

namespace App\Http\Repositories;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class UserRepository 
{
    public function create ($params) {
        return User::create([
            'name' => $params->name,
            'email' => $params->email,
            'password' => Hash::make($params->password)
        ]);
    }

    public function get (string $id) {
        return User::where('id', $id)->first();
    }

    public function getByEmail (string $email) {
        return User::where('email', "=" ,$email)->first();
    }

}