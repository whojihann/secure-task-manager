<x-app-layout>
    <x-slot name="header">
        <h2>Audit Logs</h2>
    </x-slot>

    <div class="p-6">

        <table border="1" cellpadding="10">
            <tr>
                <th>User ID</th>
                <th>Action</th>
                <th>IP Address</th>
                <th>Description</th>
                <th>Date</th>
            </tr>

            @foreach($logs as $log)
            <tr>
                <td>{{ $log->user_id }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->ip_address }}</td>
                <td>{{ $log->description }}</td>
                <td>{{ $log->created_at }}</td>
            </tr>
            @endforeach

        </table>

    </div>
</x-app-layout>
