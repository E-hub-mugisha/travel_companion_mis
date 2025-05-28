@extends('layouts.auth')
@section('content')
<div class="auth-content">
    <div class="card">
        <div class="card-body text-center">
            <div class="mb-4">
                <!-- <img class="brand" src="assets/img/bootstraper-logo.png" alt="bootstraper logo"> -->
                <h1 class="m-0"><i class="fa fa-map-marker-alt me-3"></i>Inkindi Tours</h1>
            </div>
            <h6 class="mb-4 text-muted">Login to your account</h6>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <!-- Email Address -->
                <div class="mb-3 text-start">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="mb-3 text-start">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <!-- Remember Me -->
                <div class="mb-3 text-start">
                    <div class="form-check">
                        <input class="form-check-input" name="remember" type="checkbox" value="" id="remember_me">
                        <label class="form-check-label" for="check1">
                            Remember me on this device
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mb-4" style="width:100%">Login</button>
            </form>
            @if (Route::has('password.request'))
            <p class="mb-2 text-muted">Forgot password? <a href="{{ route('password.request') }}">Reset</a></p>
            @endif
            <p class="mb-0 text-muted">Don't have account yet? <a href="{{ route('register') }}">Signup</a></p>
        </div>
    </div>
</div>
@endsection