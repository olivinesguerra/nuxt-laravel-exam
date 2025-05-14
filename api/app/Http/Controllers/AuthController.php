<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

use App\Http\Validator\AuthValidator; 
use App\Http\Services\UserService;

class AuthController extends BaseController
{
    public $auth_validator;
    public $user_service;

    public function __construct() {
        parent::__construct();  
        
        $this->auth_validator = new AuthValidator();
        $this->user_service = new UserService();
    }

    public function register(Request $request){
        try {
            $this->auth_validator->register($request);
            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function login(Request $request){
        try {
            $this->auth_validator->login($request);
            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

}