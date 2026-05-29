<x-app-layout>
    <x-slot name="header">
        <h2>Admin Dashboard</h2>
    </x-slot>

    <div class="p-6">
        <h1>Welcome Admin!</h1>

        <p>Name: {{ auth()->user()->name }}</p>

        <p>Role: {{ auth()->user()->role }}</p>
    </div>
</x-app-layout>