<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah terautentikasi
        if (!Auth::check()) {
            // Redirect ke halaman registrasi jika belum login
            return redirect()->route('register');
        }

        return $next($request);
    }
}
