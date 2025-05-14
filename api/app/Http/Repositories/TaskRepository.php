<?php

namespace App\Http\Repositories;

use App\Models\Tasks;


class TaskRepository 
{
    public function create ($params, $user) {
        return Tasks::create([
            'title' => $params->title,
            'description' => $params->description,
            'status' => $params->status,
            'due_date' => $params->due_date,
            'owner_id' => $user->id
        ]);
    }

    public function update (string $id, $params) {
        return Tasks::where('id', $id)->update($params);
    }

    public function delete (string $id) {
        return Tasks::where('id',$id)->delete();
    }

    public function get (string $id) {
        return Tasks::where('id', $id)->first();
    }

    public function list ($user, int $page, int $limit) {
        return Tasks::where('owner_id', $user->id)->offset($page)->limit($limit)->get();
    }
}