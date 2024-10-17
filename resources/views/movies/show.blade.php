@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">{{ $movie->title }}</h1>
    <img src="{{ asset('storage/' . $movie->poster) }}" class="img-fluid mb-3" alt="{{ $movie->title }}">

    <p><strong>Genre:</strong> {{ $movie->genre }}</p>
    <p><strong>Description:</strong> {{ $movie->description }}</p>

    @auth
        @if (!auth()->user()->isAdmin())
        <form action="{{ route('movies.buy', $movie->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="quantity">Quantity:</label>
                <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" required>
            </div>
            <button type="submit" class="btn btn-success mt-2">Buy Ticket</button>
        </form>

        @else
            <p class="mt-4">As an admin, you can manage this movie.</p>
        @endif
    @endauth

    <a href="{{ route('movies.index') }}" class="btn btn-secondary mt-3">Back to Movies</a>
</div>
@endsection

