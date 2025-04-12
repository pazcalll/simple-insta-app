<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserPostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', fn () => response()->json(['message' => 'pong']));

Route::post('/register', [AuthController::class, 'register']);
Route::apiResource('/auth', AuthController::class)->only(['store', 'destroy']);

Route::apiResource('/posts', PostController::class)->only(['show', 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/users/{user}/posts', UserPostController::class)->only(['index']);
    Route::apiResource('/posts/{post}/likes', LikeController::class)->only(['store', 'destroy']);
    Route::apiResource('/posts', PostController::class)->except(['update', 'show', 'index']);
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show']);