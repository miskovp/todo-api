<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * GET /tasks
     * Возвращает список всех задач.
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * POST /tasks
     * Создает новую задачу.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:pending,completed'
        ]);

        $task = Task::create($validated);

        return response()->json($task, 201);
    }

    /**
     * GET /tasks/{id}
     * Показывает одну конкретную задачу.
     */
    public function show(string $id)
    {
        return Task::findOrFail($id);
    }

    /**
     * PUT /tasks/{id}
     * Обновляет существующую задачу.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'status' => 'nullable|string|in:pending,completed'
        ]);

        $task->update($validated);

        return response()->json($task);
    }

    /**
     * DELETE /tasks/{id}
     * Удаляет задачу.
     */
    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        // 204 No Content
        return response()->noContent();
    }
}
