<x-app-layout>
    <x-slot name="header">
        <h2>Edit Task</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('tasks.update', $task) }}">
            @csrf
            @method('PUT')

            <label>Title</label><br>
            <input type="text" name="title" value="{{ $task->title }}"><br><br>

            <label>Description</label><br>
            <textarea name="description">{{ $task->description }}</textarea><br><br>

            <label>Due Date</label><br>
            <input type="date" name="due_date" value="{{ $task->due_date }}"><br><br>

            <button type="submit">Update Task</button>
        </form>
    </div>
</x-app-layout>