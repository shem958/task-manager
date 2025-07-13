@extends('layouts.app')

@section('content')
@if(auth()->user()->is_admin)
<a href="{{ route('tasks.create') }}">Create Task</a>
@endif

<table>
    <tr>
        <th>Title</th>
        <th>Status</th>
        <th>Deadline</th>
        @if(auth()->user()->is_admin)<th>User</th>@endif
        <th>Action</th>
    </tr>
    @foreach($tasks as $task)
    <tr>
        <td>{{ $task->title }}</td>
        <td>
            <select class="status-select" data-task-id="{{ $task->id }}">
                @foreach(['Pending', 'In Progress', 'Completed'] as $status)
                    <option value="{{ $status }}" {{ $task->status == $status ? 'selected' : '' }}>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </td>
        <td>{{ $task->deadline }}</td>
        @if(auth()->user()->is_admin)<td>{{ $task->user->name }}</td>@endif
        <td><a href="{{ route('tasks.edit', $task) }}">Edit</a></td>
    </tr>
    @endforeach
</table>
@endsection
