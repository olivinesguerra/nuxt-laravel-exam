<?php

namespace App\Http\Repositories;

use App\Models\Task;


class TaskRepository 
{
    public function create ($params) {
        return Task::create([
            'title' => $params->title,
            'description' => $params->description,
            'status' => $params->status,
            'due_date' => $params->due_date
        ]);
    }

    public function update (string $id, $params) {
        return Task::where('id',$id)->update($params);
    }

    public function delete (string $id) {
        return Task::delete($id);
    }

    public function get (string $id) {
        return Task::where('id', $id)->get();
    }

    public function list (int $page, int $limit) {
        return Task::where('id', $id)->offset($page)->limit($limit)->get();
    }
}