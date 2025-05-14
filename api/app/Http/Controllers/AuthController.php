<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;

use App\Http\Validator\AuthValidator; 

class AuthController extends BaseController
{
    public $auth_validator;

    public function __construct() {
        parent::__construct();  
        
        $this->auth_validator = new AuthValidator();
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