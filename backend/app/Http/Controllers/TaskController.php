<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class TaskController extends BaseController
{
    public function __construct() {
        parent::__construct();
    }

    public function create (Request $request) {
        try {
            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update (string $id, Request $request) {
        try {
            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete (string $id) {
        try {
            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function get (string $id) {
        try {
            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function list (Request $request) {
        try {
            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
