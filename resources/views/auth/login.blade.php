@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
::placeholder {
    color: #9BA3AF !important;
    opacity: 1;
}
</style>

<div class="min-vh-100 d-flex align-items-center justify-content-center">
    <div class="card shadow-lg" style="width: 400px; background-color: #1B2231; border-radius: 16px; border: 1px solid rgba(255, 255, 255, 0.1);">
        <div class="p-4">
            <h2 class="text-center text-white mb-3">Welcome back</h2>
            <p class="text-center mb-4" style="color: #9BA3AF;">Sign in to your account to continue</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
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

                <button type="submit" class="btn w-100" style="background-color: #FFB800;">Sign in</button>

                <div class="text-center mt-3">
                    <span class="text-white">Don't have an account?</span> <a href="{{ route('register') }}" class="text-warning">Sign up</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
