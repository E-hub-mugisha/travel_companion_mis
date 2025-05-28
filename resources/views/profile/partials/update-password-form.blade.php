<div class="card widget-card p-4 border-light shadow-sm bg-white shadow sm:rounded-lg">
    <h2 class="h5 text-primary">Update Password</h2>
    <p class="text-muted mb-4">
        Ensure your account is using a long, random password to stay secure.
    </p>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <!-- Current Password -->
        <div class="mb-3">
            <label for="current_password" class="form-label">Current Password</label>
            <input type="password" name="current_password" class="form-control" id="current_password" required autocomplete="current-password">
            @if ($errors->updatePassword->has('current_password'))
                <div class="text-danger mt-1">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <!-- New Password -->
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" name="password" class="form-control" id="password" required autocomplete="new-password">
            @if ($errors->updatePassword->has('password'))
                <div class="text-danger mt-1">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required autocomplete="new-password">
            @if ($errors->updatePassword->has('password_confirmation'))
                <div class="text-danger mt-1">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <!-- Submit Button + Success Message -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">
                Save
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-success small">Password updated successfully.</span>
            @endif
        </div>
    </form>
</div>
