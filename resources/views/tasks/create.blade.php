<x-app-layout>
    <x-slot name="header">
        <h2>Create Task</h2>
    </x-slot>

    <div class="p-6">

        <form method="POST" action="{{ route('tasks.store') }}">
            @csrf

            <label>Title</label><br>
            <input type="text" name="title"><br><br>

            <label>Description</label><br>
            <textarea name="description"></textarea><br><br>

            <label>Due Date</label><br>
            <input type="date" name="due_date"><br><br>

            <button type="submit">
                Save Task
            </button>
        </form>

    </div>
</x-app-layout>