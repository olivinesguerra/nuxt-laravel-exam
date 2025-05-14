<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;

Route::get('/task/{id}', [TaskController::class, 'get']);
Route::delete('/task/{id}', [TaskController::class, 'delete']);
Route::put('/task/{id}', [TaskController::class, 'update']);
Route::post('/task', [TaskController::class, 'create']);
