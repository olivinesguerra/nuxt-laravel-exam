<?php

namespace App\Http\Services;
use Exception;
use Illuminate\Http\Request;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserService 
{
    private $user_repository;

    public function __construct() {
        $this->user_repository = new UserRepository();
    }

    public function register (Request $request) {

        $user = $this->user_repository->getByEmail($request->email);

        if (!is_null($user)) {
            throw new Exception('User exists', 500);
        }

       $user = $this->user_repository->create($request);

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

       return [
            'token' => $token,
            'user' => $user,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }

    public function login (Request $request) {

        $user = $this->user_repository->getByEmail($request->email);

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw new Exception('The provided credentials are incorrect', 500);
        }

        try {
            $token = JWTAuth::fromUser($user);
        } catch (JWTException $e) {
            throw new Exception('Could not create token', 500);
        }

        return [
            'token' => $token,
            'user' => $user,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }


}