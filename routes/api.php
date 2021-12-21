<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

// public routes
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('auth/login', [AuthController::class, 'login']);
Route::get('/posts/list', [PostController::class, 'unAuthenticatedList']);

Route::group(['middleware' => ['auth:sanctum']],function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::resource('posts', PostController::class)->except('index');
});
