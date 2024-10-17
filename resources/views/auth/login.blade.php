@extends('layouts.app')

@section('content')
<div class="sidenav d-flex justify-content-center align-items-center">
    <div class="login-main-text text-center">
        <h2>Welcome to the Application</h2>
        <p>Please login or register to access the platform.</p>
    </div>
</div>

<div class="main d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-lg-5 col-md-8 col-sm-12">
        <div class="card shadow p-4">
            <h3 class="text-center mb-4">Login</h3>
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group mb-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Enter your password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                    <a href="{{ route('register') }}" class="btn btn-outline-secondary">Register</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
