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
        return  $this->task_repository->create($request);
    }

    public function update (string $id, Request $request) {
        return $this->task_repository->update($id, $request);
    }

    public function delete (string $id) {
        return $this->task_repository->delete($id);
    }

    public function get (string $id) {
        return  $this->task_repository->get($id);
    }

    public function list (Request $request) {
        $limit =$request->filled('limit') ? $request->limit : 20;
        $page = $request->filled('page') ? $request->page : 0;
        $data = $this->task_repository->list($page, $limit);
        return $data;
    }
}