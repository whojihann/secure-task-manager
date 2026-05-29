<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\AuditLog;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::where('user_id', auth()->id())->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'due_date' => 'nullable|date',
    ]);

    Task::create([
        'user_id' => auth()->id(),
        'title' => $request->title,
        'description' => $request->description,
        'due_date' => $request->due_date,
    ]);

    AuditLog::create([
        'user_id' => auth()->id(),
        'action' => 'CREATE_TASK',
        'ip_address' => $request->ip(),
        'description' => 'Created task: ' . $request->title,
    ]);

    return redirect()->route('tasks.index')
                     ->with('success', 'Task created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        if ($task->user_id !== auth()->id()) {
            abort(403);
        }

        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
{
    if ($task->user_id !== auth()->id()) {
        abort(403);
    }

    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'due_date' => 'nullable|date',
    ]);

    $task->update([
        'title' => $request->title,
        'description' => $request->description,
        'due_date' => $request->due_date,
    ]);

    AuditLog::create([
        'user_id' => auth()->id(),
        'action' => 'UPDATE_TASK',
        'ip_address' => $request->ip(),
        'description' => 'Updated task: ' . $task->title,
    ]);

    return redirect()->route('tasks.index')
                     ->with('success', 'Task updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
{
    if ($task->user_id !== auth()->id()) {
        abort(403);
    }

    AuditLog::create([
        'user_id' => auth()->id(),
        'action' => 'DELETE_TASK',
        'ip_address' => request()->ip(),
        'description' => 'Deleted task: ' . $task->title,
    ]);

    $task->delete();

    return redirect()->route('tasks.index')
                     ->with('success', 'Task deleted successfully.');
}
}
