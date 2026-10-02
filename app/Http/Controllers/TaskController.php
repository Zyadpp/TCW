<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->string('status')->toString();
        $tasks = Task::query()
            ->when(in_array($status, ['To do', 'In progress', 'Completed'], true), fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.tasks.index', compact('tasks', 'status'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'assignee' => ['nullable', 'string', 'max:120'],
            'due_date' => ['nullable', 'date'],
            'priority' => ['required', 'in:Low,Medium,High'],
        ]);

        Task::create($validated + ['status' => 'To do']);

        return to_route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function updateStatus(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:To do,In progress,Completed'],
        ]);

        $task->update($validated);

        return back()->with('success', 'Task status updated.');
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'], 'description' => ['nullable', 'string', 'max:1000'],
            'assignee' => ['nullable', 'string', 'max:120'], 'due_date' => ['nullable', 'date'],
            'priority' => ['required', 'in:Low,Medium,High'], 'status' => ['required', 'in:To do,In progress,Completed'],
        ]);
        $task->update($validated);
        return back()->with('success', 'Task updated.');
    }

    public function destroy(Task $task): RedirectResponse
    {
        $task->delete();

        return back()->with('success', 'Task deleted.');
    }
}
