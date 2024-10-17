<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        // If there is a search query, filter the movies by the title and paginate the result
        if ($search) {
            $movies = Movie::where('title', 'LIKE', '%' . $search . '%')->paginate(4);
        } else {
            // Otherwise, paginate all movies
            $movies = Movie::paginate(4);
        }

        // Return the paginated movies to the view
        return view('movies.index', compact('movies'));
    }



    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $this->validateMovie($request);

        $posterPath = $this->handlePosterUpload($request);

        Movie::create([
            'title' => $request->title,
            'genre' => $request->genre,
            'description' => $request->description,
            'poster' => $posterPath,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie added successfully.');
    }
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.show', compact('movie'));
    }


    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, $id)
    {
        $this->validateMovie($request);

        $movie = Movie::findOrFail($id);

        if ($request->hasFile('poster')) {
            $posterPath = $this->handlePosterUpload($request);
            $movie->poster = $posterPath;
        }

        $movie->update($request->only(['title', 'genre', 'description']));

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        if ($movie->poster) {
            Storage::delete('public/' . $movie->poster);
        }
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }


    private function validateMovie(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'genre' => 'required',
            'description' => 'required',
            'poster' => 'nullable|image',
        ]);
    }

    private function handlePosterUpload(Request $request)
    {
        return $request->file('poster')->store('posters', 'public');
    }
    public function buy(Request $request, $movieId)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    $movie = Movie::findOrFail($movieId);
    $user = auth()->user();

    // Create a new ticket record in the database
    Ticket::create([
        'user_id' => $user->id,
        'movie_id' => $movie->id,
        'quantity' => $request->quantity
    ]);

    // Redirect back with a success message
    return redirect()->route('movies.show', $movieId)->with('success', 'Ticket has been purchased successfully!');
}


}
