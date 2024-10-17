<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TicketController;

// Admin Routes (Requires authentication and admin check)
Route::middleware(['auth.redirect', 'isAdmin'])->group(function () {
    Route::resource('movies', MovieController::class);
    Route::get('/admin', [MovieController::class, 'adminIndex']);
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index'); // View tickets
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create'); // Create ticket form
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store'); // Store new ticket
    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit'); // Edit ticket form
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update'); // Update ticket
    Route::delete('/tickets/{ticket}', [TicketController::class, 'destroy'])->name('tickets.destroy'); // Delete ticket
});

// Movie Routes (Requires authentication)
Route::get('/', [MovieController::class, 'index'])->middleware('auth.redirect');
Route::get('/movies/{id}', [MovieController::class, 'show'])->middleware('auth.redirect');
Route::post('/movies/{id}/buy', [MovieController::class, 'buy'])->middleware('auth.redirect');

// Route for movies with defined route names
Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}', [MovieController::class, 'show'])->name('movies.show');
Route::post('/movies/{movie}/buy', [MovieController::class, 'buy'])->name('movies.buy');

// Authentication Routes

// GET routes for login and register forms
Route::get('/login', [AuthController::class, 'showForm'])->name('login')->middleware('guest');
Route::get('/register', [AuthController::class, 'showForm'])->name('register')->middleware('guest');

// POST routes for handling login and register actions
Route::post('/login', [AuthController::class, 'handleLogin'])->name('login.handle')->middleware('guest');
Route::post('/register', [AuthController::class, 'handleRegister'])->name('register.handle')->middleware('guest');

// POST route for logout (logout should be POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// You shouldn't need a GET route for logout; logout actions should always use POST for security reasons.
// Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth'); (remove this line)
