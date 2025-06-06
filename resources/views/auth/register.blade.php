@extends('layouts.auth')
@section('content')
<div class="auth-content">
    <div class="card">
        <div class="card-body">
            <div class="mb-4">
                <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Inkindi Tours</h1>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                    <error :messages="$errors->get('name')" class="mt-2">
                </div>

                <!-- Email Address -->
                <div class="form-group mt-4">
                    <label for="email">Email</label>
                    <input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username">
                    <error :messages="$errors->get('email')" class="mt-2">
                </div>

                <!-- Password -->
                <div class="form-group mt-4">
                    <label for="password">Password</label>

                    <input id="password" class="form-control"
                        type="password"
                        name="password"
                        required autocomplete="new-password">

                    <error :messages="$errors->get('password')" class="mt-2">
                </div>

                <!-- Confirm Password -->
                <div class="form-group mt-4">
                    <label for="password_confirmation">Confirm Password</label>

                    <input id="password_confirmation" class="form-control"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password">

                    <error :messages="$errors->get('password_confirmation')" class="mt-2">
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button class="btn btn-success ms-4">
                        {{ __('Register') }}
                    </button>
                </div>
            </form>
            @if (Route::has('password.request'))
            <p class="mb-2 text-muted">Forgot password? <a href="{{ route('password.request') }}">Reset</a></p>
            @endif
            <p class="mb-0 text-muted">Don't have account yet? <a href="{{ route('register') }}">Signup</a></p>
        </div>
    </div>
</div>
@endsection