<?php

namespace App\Http\Validator;

use Illuminate\Validation\Rule;
use App\Http\Util\Enums\TaskStatus;

class TaskValidator 
{
    public function create($request)
    {
        $validator = $request->validate([
            'title' => 'required|integer|min:1',
            'order' => 'required|integer|min:1',
            'status' => ['required', Rule::in([
                TaskStatus::ACTIVE, 
                TaskStatus::COMPLETE, 
                TaskStatus::INACTIVE, 
                TaskStatus::IN_PROGRESS
            ])],
            'due_date' => 'required|numeric|min:1',
        ]);
        
        if ($validator->fails()) {
            throw new Exception($validator->errors(), 422);
        }
    }

    public function update($request)
    {
        $validator = $request->validate([
            'title' => 'nullable|integer|min:1',
            'order' => 'nullable|integer|min:1',
            'status' => ['nullable', Rule::in([
                TaskStatus::ACTIVE, 
                TaskStatus::COMPLETE, 
                TaskStatus::INACTIVE, 
                TaskStatus::IN_PROGRESS
            ])],
            'due_date' => 'nullable|numeric|min:1',
        ]);
        
        if ($validator->fails()) {
            throw new Exception($validator->errors(), 422);
        }
    }

}