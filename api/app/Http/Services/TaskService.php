<?php

namespace App\Http\Services;
use Exception;
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

        $params = [];

        $task = $this->task_repository->get($id);

        if (is_null($task) && empty($task)) {
            throw new Exception("Task does not exist.", 422);
        }

        $task->title = $request->filled('title') ? $request->title : $task->title;
        $task->description = $request->filled('description') ? $request->description : $task->description;
        $task->due_date = $request->filled('due_date') ? $request->due_date : $task->due_date;
        $task->status = $request->filled('status') ? $request->status : $task->status;

        return $task->save();
    }

    public function delete (string $id) {
        return $this->task_repository->delete($id);
    }

    public function get (string $id) {
        return  $this->task_repository->get($id);
    }

    public function list (Request $request) {
        $limit = $request->filled('limit') ? $request->limit : 20;
        $page = $request->filled('page') ? $request->page : 0;
        $data = $this->task_repository->list($page, $limit);
        return $data;
    }
}