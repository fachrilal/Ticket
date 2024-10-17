@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Manage Tickets</h1>

    @if ($tickets->count() > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Movie</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->user->name }}</td>
                    <td>{{ $ticket->movie->title }}</td>
                    <td>{{ $ticket->quantity }}</td>
                    <td>
                        <!-- Edit Ticket (if necessary) -->
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-primary btn-sm">Edit</a>

                        <!-- Delete Ticket -->
                        <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this ticket?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        {{ $tickets->links() }}

    @else
        <div class="alert alert-info">
            No tickets available.
        </div>
    @endif
</div>
@endsection
