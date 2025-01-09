<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the API!']);
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{email}', [UserController::class, 'show']);
Route::put('/users/{email}', [UserController::class, 'update']);
Route::post('/users', [UserController::class, 'store']);
