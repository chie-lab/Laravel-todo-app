<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TodoController extends Controller
{
    public function index(): View
    {
        $todos = Todo::query()
            ->orderBy('order')
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

        $minOrder = Todo::query()->min('order') ?? 1;
        Todo::query()->create(array_merge($validated, ['order' => $minOrder - 1]));

        return redirect()
            ->route('todos.index')
            ->with('status', 'Todoを追加しました。');
    }

    public function updateCompletion(Request $request, Todo $todo): RedirectResponse
    {
        $validated = $request->validate([
            'is_completed' => ['required', 'boolean'],
        ]);

        $todo->update($validated);

        return redirect()
            ->route('todos.index')
            ->with('status', 'Todoの状態を更新しました。');
    }

    public function destroy(Todo $todo): RedirectResponse
    {
        $todo->delete();

        return redirect()
            ->route('todos.index')
            ->with('status', 'Todoを削除しました。');
    }

    public function reorder(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'ids'   => ['required', 'array'],
            'ids.*' => ['required', 'integer', 'exists:todos,id'],
        ]);

        foreach ($validated['ids'] as $order => $id) {
            Todo::query()->where('id', $id)->update(['order' => $order]);
        }

        return response()->json(['ok' => true]);
    }
}
