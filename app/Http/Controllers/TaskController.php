<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = auth()->user()->is_admin
            ? Task::with('user')->get()
            : auth()->user()->tasks;

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $request)
    {
        $task = Task::create($request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'description' => 'nullable|string',
            'deadline' => 'required|date'
        ]));

        // Send Email
        Mail::raw("A new task '{$task->title}' has been assigned to you.",
            fn($message) => $message->to($task->user->email)->subject('New Task Assigned'));

        return redirect()->route('tasks.index')->with('success', 'Task assigned.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->only(['status', 'title', 'description', 'deadline']);

        $task->update($data);
        return back()->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return back()->with('success', 'Task deleted.');
    }
}
