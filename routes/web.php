<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('admin')->group(function () {
    Route::get('/admin/user', [UserController::class, 'create'])->name('user.create');
    Route::post('/admin/user', [UserController::class, 'store'])->name('user.store');
});

Route::get('/user/edit', [UserController::class, 'edit'])->name('user.edit');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('show.password.change');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
Route::get('/projects/{projectId}/boards', [BoardController::class, 'index'])->name('boards.index');
Route::get('/boards', [BoardController::class, 'list'])->name('boards.list');
Route::get('/boards/{boardId}/columns', [BoardController::class, 'columns'])->name('boards.columns');
Route::post('/board/store', [BoardController::class, 'store'])->name('boards.store');
Route::put('/boards/{boardId}', [BoardController::class, 'update'])->name('boards.update');
Route::delete('/boards/{boardId}', [BoardController::class, 'destroy'])->name('boards.destroy');

Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');

Route::get('/tasks/{id}', [TaskController::class, 'show'])->name('tasks.show');
