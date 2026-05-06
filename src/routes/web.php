<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

// ゲストのみアクセス可（ログイン済みは todos.index へリダイレクト）
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ログアウト
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 認証済みのみアクセス可
Route::middleware('auth')->group(function () {
    Route::get('/', [TodoController::class, 'index'])->name('todos.index');
    Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
    Route::patch('/todos/reorder', [TodoController::class, 'reorder'])->name('todos.reorder');
    Route::patch('/todos/{todo}/completion', [TodoController::class, 'updateCompletion'])->name('todos.update-completion');
    Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
});
