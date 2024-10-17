@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Movie</h1>

    <form action="{{ route('movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $movie->title) }}" required>
        </div>

        <div class="form-group">
            <label for="genre">Genre</label>
            <input type="text" name="genre" id="genre" class="form-control" value="{{ old('genre', $movie->genre) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ old('description', $movie->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="poster">Poster</label>
            <input type="file" name="poster" id="poster" class="form-control">
            <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="img-thumbnail mt-2" width="200">
        </div>

        <button type="submit" class="btn btn-primary">Update Movie</button>
    </form>
</div>
@endsection
