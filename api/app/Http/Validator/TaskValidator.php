<?php

namespace App\Http\Validator;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Validator;

use App\TaskStatus;

class TaskValidator 
{
    public function create($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|min:1',
            'description' => 'nullable|string|min:1',
            'due_date' => 'nullable|numeric|min:1',
            'order' => 'required|numeric|min:1',
            'status' => ['required', new Enum(TaskStatus::class)]
        ]);
     
        
        if ($validator->fails()) {
            throw new Exception($validator->errors(), 422);
        }
    }

    public function update($request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'nullable|string|min:1',
            'description' => 'nullable|string|min:1',
            'due_date' => 'nullable|numeric|min:1',
            'order' => 'nullable|numeric|min:1',
            'status' => ['nullable', new Enum(TaskStatus::class)]
        ]);

        if ($validator->fails()) {
            throw new Exception($validator->errors(), 422);
        }
    }

}