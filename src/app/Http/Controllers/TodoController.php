<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function index(): View
    {
        $todos = Todo::query()
            ->latest()
            ->get();

        return view('todos.index', [
            'todos' => $todos,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        Todo::query()->create($validated);

        return redirect()
            ->route('todos.index')
            ->with('status', 'Todoを追加しました。');
    }
}
