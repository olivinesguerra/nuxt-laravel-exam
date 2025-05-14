<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Repositories\TaskRepository;

class TaskService 
{
    private $task_repository;

    public function __construct() {
        $this->task_repository = new TaskRepository();
    }

    public function create (Request $request) {
        return null;
    }

    public function update (string $id, Request $request) {
        return null;
    }

    public function delete (string $id) {
        return null;
    }

    public function get (string $id) {
        return null;
    }

    public function list (Request $request) {
        $limit =$request->filled('limit') ? $request->limit : 20;
        $page = $request->filled('page') ? $request->page : 0;
        $data = $this->task_repository->list($page, $limit);
        return $data;
    }
}