<?php

namespace App\Http\Repositories;

use App\Models\Tasks;


class TaskRepository 
{
    public function create ($params) {
        return Tasks::create([
            'title' => $params->title,
            'description' => $params->description,
            'status' => $params->status,
            'due_date' => $params->due_date
        ]);
    }

    public function update (string $id, $params) {
        return Tasks::where('id',$id)->update($params);
    }

    public function delete (string $id) {
        return Tasks::delete($id);
    }

    public function get (string $id) {
        return Tasks::where('id', $id)->get();
    }

    public function list (int $page, int $limit) {
        return Tasks::where('id', $id)->offset($page)->limit($limit)->get();
    }
}