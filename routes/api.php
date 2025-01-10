<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the API!']);
});

Route::apiResource('users', UserController::class);
