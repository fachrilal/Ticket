@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Ticket</h1>

    <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="user_id">User</label>
            <select name="user_id" id="user_id" class="form-control" required>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $ticket->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="movie_id">Movie</label>
            <select name="movie_id" id="movie_id" class="form-control" required>
                @foreach ($movies as $movie)
                    <option value="{{ $movie->id }}" {{ $ticket->movie_id == $movie->id ? 'selected' : '' }}>{{ $movie->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $ticket->quantity }}" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Ticket</button>
    </form>
</div>
@endsection
