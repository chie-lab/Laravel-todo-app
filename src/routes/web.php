<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TodoController::class, 'index'])->name('todos.index');
Route::post('/todos', [TodoController::class, 'store'])->name('todos.store');
Route::patch('/todos/{todo}/completion', [TodoController::class, 'updateCompletion'])->name('todos.update-completion');
Route::delete('/todos/{todo}', [TodoController::class, 'destroy'])->name('todos.destroy');
