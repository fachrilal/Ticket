<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movie;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      // List all tickets
      public function index()
      {
          $tickets = Ticket::with('user', 'movie')->get(); // Eager load user and movie
          return view('tickets.index', compact('tickets'));
      }

      // Show create form
      public function create()
      {
          $users = User::all();
          $movies = Movie::all();
          return view('tickets.create', compact('users', 'movies'));
      }

      // Store new ticket
      public function store(Request $request)
      {
          $request->validate([
              'user_id' => 'required|exists:users,id',
              'movie_id' => 'required|exists:movies,id',
              'quantity' => 'required|integer|min:1'
          ]);

          Ticket::create($request->all());

          return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
      }

      // Show edit form
      public function edit(Ticket $ticket)
      {
          $users = User::all();
          $movies = Movie::all();
          return view('tickets.edit', compact('ticket', 'users', 'movies'));
      }

      // Update ticket
      public function update(Request $request, Ticket $ticket)
      {
          $request->validate([
              'user_id' => 'required|exists:users,id',
              'movie_id' => 'required|exists:movies,id',
              'quantity' => 'required|integer|min:1'
          ]);

          $ticket->update($request->all());

          return redirect()->route('tickets.index')->with('success', 'Ticket updated successfully.');
      }

      // Delete ticket
      public function destroy(Ticket $ticket)
      {
          $ticket->delete();
          return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
      }
    public function show(string $id)
    {
        //
    }
}
