<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


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
require __DIR__.'/auth.php';
