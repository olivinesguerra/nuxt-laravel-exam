<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller as BaseController;
use App\Http\Validator\TaskValidator; 
use App\Http\Services\TaskService;

class TaskController extends BaseController
{
    public $task_validator;
    public $task_service;

    public function __construct() {
        parent::__construct();
        $this->task_validator = new TaskValidator();
        $this->task_service = new TaskService();
    }

    public function create (Request $request) {
        try {
            $user = auth()->user();
            $this->task_validator->create($request);
            $data = $this->task_service->create($request,$user);
            return $this->responseSuccess($data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update (string $id, Request $request) {
        try {
            $this->task_validator->update($request);
            $this->task_service->update($id, $request);
            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function delete (string $id) {
        try {
            $this->task_service->delete($id);
            return $this->responseSuccess();
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function get (string $id) {
        try {
            $data = $this->task_service->get($id);
            return $this->responseSuccess($data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }

    public function list (Request $request) {
        try {
            $user = auth()->user();
            $data = $this->task_service->list($request, $user);
            return $this->responseSuccess($data);
        } catch (Exception $e) {
            return $this->handleException($e);
        }
    }
}
