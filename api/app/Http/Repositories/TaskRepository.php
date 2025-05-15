<?php

namespace App\Http\Repositories;

use App\Models\Task;


class TaskRepository 
{
    public function create ($params, $user) {
        return Task::create([
            'title' => $params->title,
            'description' => $params->description,
            'status' => $params->status,
            'due_date' => $params->due_date,
            'owner_id' => $user->id,
            'order' => $params->order,
        ]);
    }

    public function increment_less_than_order($user, $status, $order) {
        return Task::where('order','<=', $order)
            ->where('status',"=", $status)
            ->where('owner_id',"=", $user->id)
            ->increment('order');
    }

    public function decrement_greater_than_order($user, $status, $order) {
        return Task::where('order','>', $order)
            ->where('status',"=", $status)
            ->where('owner_id',"=", $user->id)
            ->decrement('order');
    }

    public function update (string $id, $params) {
        return Task::where('id', $id)->update($params);
    }

    public function delete (string $id) {
        return Task::where('id',$id)->delete();
    }

    public function get (string $id) {
        return Task::where('id', $id)->first();
    }

    public function list ($user, $status, int $page, int $limit) {

        if (is_null($status)) {
            return Task::where('owner_id', $user->id)
                ->offset($page)
                ->limit($limit)
                ->orderBy("order", "ASC")
                ->get();
        }

        return Task::where('owner_id', $user->id)
            ->where('status',"=", $status)
            ->offset($page)
            ->limit($limit)
            ->orderBy("order", "ASC")
            ->get();
    }
}