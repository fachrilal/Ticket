@extends('layouts.app')

@section('content')
<div class="container text-center my-5">
    <!-- Title Section -->
    <h2 class="mb-4">Now Showing in Cinemas</h2>

    <!-- Movie List Section (No Carousel, just Grid) -->
    <div class="row justify-content-center">
        @foreach ($movies as $movie)
        <div class="col-lg-3 col-md-4 col-sm-6 col-12 mb-4">
            <div class="card movie-card">
                <img src="{{ asset('storage/' . $movie->poster) }}" class="card-img-top" alt="{{ $movie->title }}">
                <div class="card-body text-center">
                    <h5 class="movie-title">{{ $movie->title }}</h5>

                    <!-- Admin Actions: Edit and Delete -->
                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @else
                            <!-- Non-Admin Action: Buy Ticket -->
                            <form action="{{ route('movies.buy', $movie->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm">Buy Ticket</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination Links with Bootstrap Styling -->
    <div class="d-flex justify-content-center mt-4">
        <!-- Adding Bootstrap pagination classes -->
        {{ $movies->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>
@endsection
    