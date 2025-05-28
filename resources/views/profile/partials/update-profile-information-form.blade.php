<div class="card p-4 widget-card border-light shadow-sm bg-white shadow sm:rounded-lg">
    <h2 class="h5 text-primary">Profile Information</h2>
    <p class="text-muted mb-4">
        Update your account's profile information and email address.
    </p>

    <!-- Email verification form -->
    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Profile update form -->
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Names</label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="{{ old('name', $user->name) }}"
                required
                autofocus
                autocomplete="name"
            >
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email', $user->email) }}"
                required
                autocomplete="username"
            >
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="small text-warning mb-1">
                        Your email address is unverified.
                    </p>
                    <button type="submit" form="send-verification" class="btn btn-link p-0 small">
                        Click here to re-send the verification email.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <div class="text-success small mt-2">
                            A new verification link has been sent to your email address.
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit + Status -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-success btn-sm">Save</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success small">Saved.</span>
            @endif
        </div>
    </form>
</div>
