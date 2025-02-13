<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function show(int $id)
    {
        $task = Task::with(['column', 'creator', 'assignee', 'comments.user', 'labels', 'activities'])
            ->findOrFail($id);

        return Inertia::render('Task/Show', ['task' => $task]);
    }
}
