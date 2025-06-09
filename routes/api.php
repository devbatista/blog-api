<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function(){
    return 'pong';
});

Route::prefix('auth')->group(function() {
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/signin', [AuthController::class, 'signin']);
    Route::get('/verify', [AuthController::class, 'verify'])->middleware('auth:sanctum');
});

Route::get('/posts', [PostController::class, 'getPosts']);
Route::get('posts/{slug}', [PostController::class, 'getPost']);
