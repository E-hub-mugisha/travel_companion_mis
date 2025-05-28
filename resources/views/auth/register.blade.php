@extends('layouts.auth')
@section('content')
<div class="auth-content">
    <div class="card">
        <div class="card-body text-center">
            <div class="mb-4">
                <!-- <img class="brand" src="assets/img/bootstraper-logo.png" alt="bootstraper logo"> -->
                <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Inkindi Tours</h1>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" :value="__('Name')">
                    <input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name">
                    <error :messages="$errors->get('name')" class="mt-2">
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <label for="email" :value="__('Email')">
                    <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username">
                    <error :messages="$errors->get('email')" class="mt-2">
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" :value="__('Password')">

                    <input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="new-password">

                    <error :messages="$errors->get('password')" class="mt-2">
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <label for="password_confirmation" :value="__('Confirm Password')">

                    <input id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required autocomplete="new-password">

                    <error :messages="$errors->get('password_confirmation')" class="mt-2">
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
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