@extends('layouts.admin')

@section('content')
    <section class="tasks-page">
        <div class="tasks-heading">
            <div>
                <h1>Tasks</h1>
                <p>Plan work and keep the team aligned.</p>
            </div>
            <button class="new-user-btn-page" type="button" data-bs-toggle="collapse" data-bs-target="#newTaskForm" aria-expanded="{{ $errors->any() ? 'true' : 'false' }}">
                <i class="bi bi-plus"></i> New task
            </button>
        </div>

        @if (session('success'))
            <div class="settings-alert" role="status">{{ session('success') }}</div>
        @endif

        <form id="newTaskForm" class="task-create-form collapse {{ $errors->any() ? 'show' : '' }}" action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <input name="title" value="{{ old('title') }}" placeholder="Task title" required>
            <input name="assignee" value="{{ old('assignee') }}" placeholder="Assigned to">
            <input type="date" name="due_date" value="{{ old('due_date') }}" aria-label="Due date">
            <select name="priority" aria-label="Priority">
                @foreach (['Low', 'Medium', 'High'] as $priority)
                    <option value="{{ $priority }}" @selected(old('priority', 'Medium') === $priority)>{{ $priority }} priority</option>
                @endforeach
            </select>
            <button type="submit">Add task</button>
        </form>

        <nav class="task-filters" aria-label="Task status filters">
            @foreach (['All' => '', 'To do' => 'To do', 'In progress' => 'In progress', 'Completed' => 'Completed'] as $label => $value)
                <a class="{{ $status === $value ? 'active' : '' }}" href="{{ route('tasks.index', $value ? ['status' => $value] : []) }}">{{ $label }}</a>
            @endforeach
        </nav>

        <div class="task-table-card">
            <table class="table task-table align-middle mb-0">
                <thead><tr><th>TASK</th><th>ASSIGNED TO</th><th>DUE DATE</th><th>PRIORITY</th><th>STATUS</th><th></th></tr></thead>
                <tbody>
                    @forelse ($tasks as $task)
                        <tr>
                            <td><strong>{{ $task->title }}</strong>@if ($task->description)<small>{{ $task->description }}</small>@endif</td>
                            <td>{{ $task->assignee ?: 'Unassigned' }}</td>
                            <td>{{ $task->due_date?->format('j M Y') ?? 'â€”' }}</td>
                            <td><span class="task-priority {{ strtolower($task->priority) }}">{{ $task->priority }}</span></td>
                            <td>
                                <form action="{{ route('tasks.status.update', $task) }}" method="POST">
                                    @csrf @method('PUT')
                                    <select class="task-status-select" name="status" onchange="this.form.submit()" aria-label="Update {{ $task->title }} status">
                                        @foreach (['To do', 'In progress', 'Completed'] as $taskStatus)
                                            <option value="{{ $taskStatus }}" @selected($task->status === $taskStatus)>{{ $taskStatus }}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td class="text-end">
                                <details><summary>Edit</summary><form action="{{ route('tasks.update', $task) }}" method="POST">@csrf @method('PUT')<input name="title" value="{{ $task->title }}" required><input name="description" value="{{ $task->description }}"><input name="assignee" value="{{ $task->assignee }}"><input type="date" name="due_date" value="{{ $task->due_date?->format('Y-m-d') }}"><select name="priority">@foreach (['Low','Medium','High'] as $priority)<option @selected($task->priority === $priority)>{{ $priority }}</option>@endforeach</select><select name="status">@foreach (['To do','In progress','Completed'] as $taskStatus)<option @selected($task->status === $taskStatus)>{{ $taskStatus }}</option>@endforeach</select><button>Save</button></form></details>
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?')">
                                    @csrf @method('DELETE')
                                    <button class="task-delete" type="submit" aria-label="Delete {{ $task->title }}"><i class="bi bi-trash3"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td class="task-empty" colspan="6"><i class="bi bi-check2-circle"></i><strong>No tasks yet</strong><span>Create your first task to start tracking work.</span></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
