<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class BoardController extends Controller
{
    public function index($projectId)
    {
        $project = Project::findOrFail($projectId);
        $boards = $project->boards()->with('columns')->get();

        return Inertia::render('Boards/Index', [
            'project' => $project,
            'boards' => $boards,
        ]);
    }

    public function list()
    {
        $boards = Board::all();

        return Inertia::render('Boards/List', [
            'boards' => $boards,
        ]);
    }

    public function create()
    {
        return Inertia::render('Boards/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'project_id' => 'required|integer|exists:projects,id',
        ]);

        $board = new Board();
        $board->name = $validatedData['title'];
        $board->project_id = $validatedData['project_id'];
        $board->save();

        return redirect()->route('boards.index', $validatedData['project_id'])
            ->with('success', 'Доска успешно создана!');
    }

    public function update(Request $request, $boardId)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $board = Board::findOrFail($boardId);
        $board->name = $validatedData['name'];
        $board->save();

        return redirect()->route('boards.index', $board->project_id)
            ->with('success', 'Доска успешно обновлена!');
    }

    public function destroy($boardId)
    {
        $board = Board::findOrFail($boardId);
        $projectId = $board->project_id;
        $board->delete();

        return redirect()->route('boards.index', $projectId)
            ->with('success', 'Доска успешно удалена!');
    }

    public function columns($boardId)
    {
        $board = Board::findOrFail($boardId);
        $columns = $board->columns()->with('tasks')->get();

        return Inertia::render('Boards/Columns', [
        'columns' => $columns,
        'boardName' => $board->name,
        'boardId' => $board->id,
    ]);
    }
}
