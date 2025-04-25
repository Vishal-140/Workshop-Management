@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow-lg" style="width: 400px; background-color: #1B2231; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="p-4">
            <h2 class="text-center text-white mb-3">Create Account</h2>
            <p class="text-center mb-4" style="color: #9BA3AF;">Sign up to get started</p>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="username" class="form-label text-white">Username</label>
                    <input type="text" class="form-control text-white border-0" id="username" name="username" value="{{ old('username') }}" placeholder="Enter your username" style="background-color: #293241;" required>
                    @error('username')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label text-white">Email</label>
                    <input type="email" class="form-control text-white border-0" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email" style="background-color: #293241;" required>
                    @error('email')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label text-white">Password</label>
                    <input type="password" class="form-control text-white border-0" id="password" name="password" placeholder="Enter your password" style="background-color: #293241;" required>
                    @error('password')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password_confirmation" class="form-label text-white">Confirm Password</label>
                    <input type="password" class="form-control text-white border-0" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" style="background-color: #293241;" required>
                </div>

                <button type="submit" class="btn w-100" style="background-color: #FFB800;">Sign up</button>

                <div class="text-center mt-3">
                    <span class="text-white">Already have an account?</span> <a href="{{ route('login') }}" class="text-warning">Sign in</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
