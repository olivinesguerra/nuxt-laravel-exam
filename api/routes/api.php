<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;

Route::group(['prefix' => 'task'], function () {
    Route::get('/{id}', [TaskController::class, 'get']);
    Route::delete('/{id}', [TaskController::class, 'delete']);
    Route::put('/{id}', [TaskController::class, 'update']);
    Route::post('/', [TaskController::class, 'create']);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
});
