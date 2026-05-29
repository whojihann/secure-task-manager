<x-app-layout>
    <x-slot name="header">
        <h2>My Tasks</h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('tasks.create') }}">
            Create Task
        </a>

        <hr><br>

    @foreach($tasks as $task)
        <h3>{{ $task->title }}</h3>
        <p>{{ $task->description }}</p>
        <p>{{ $task->due_date }}</p>

        <a href="{{ route('tasks.edit', $task) }}">Edit</a>

        <form method="POST" action="{{ route('tasks.destroy', $task) }}" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>

        <hr>
    @endforeach
    
    </div>
</x-app-layout>