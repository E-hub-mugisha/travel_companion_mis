<!-- Delete Account Section -->
<div class="card widget-card p-4 border-light shadow-sm bg-white shadow sm:rounded-lg">
    <h2 class="h5 text-danger">Delete Account</h2>
    <p class="text-muted">
        Once your account is deleted, all of its resources and data will be permanently removed.
        Please download any data you wish to keep before proceeding.
    </p>

    <!-- Trigger Modal -->
    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
        Delete Account
    </button>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('profile.destroy') }}" class="modal-content">
            @csrf
            @method('DELETE')

            <div class="modal-header">
                <h5 class="modal-title text-danger" id="deleteAccountModalLabel">Confirm Account Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>
                    Are you sure you want to delete your account? This action cannot be undone.
                    Please enter your password to confirm.
                </p>

                <div class="mb-3">
                    <label for="deletePassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="deletePassword" required placeholder="Enter your password">
                    @if ($errors->userDeletion->has('password'))
                        <div class="text-danger mt-1">{{ $errors->userDeletion->first('password') }}</div>
                    @endif
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">
                    Delete Account
                </button>
            </div>
        </form>
    </div>
</div>
