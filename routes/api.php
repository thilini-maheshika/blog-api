<?php

use Illuminate\Support\Facades\Route; // Add this import
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('posts', PostController::class);
    Route::resource('posts.comments', CommentController::class);
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::delete('posts/{post}', [PostController::class, 'destroy']);
    Route::delete('posts/{post}/comments/{comment}', [CommentController::class, 'destroy']);
});
