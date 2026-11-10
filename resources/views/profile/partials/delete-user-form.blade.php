<section>
    <p class="text-muted mb-3">
        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your
        account, please download any data or information that you wish to retain.
    </p>

    <form method="post" action="{{ route('profile.destroy') }}"
        onsubmit="return confirm('Are you absolutely sure you want to delete your account? This cannot be undone.');">
        @csrf
        @method('delete')

        <div class="form-group mb-3">
            <label for="password" class="font-weight-bold mb-1">Confirm Password</label>
            <input id="password" name="password" type="password"
                class="form-control @error('password', 'userDeletion') is-invalid @enderror"
                placeholder="Enter your password to confirm">
            @error('password', 'userDeletion')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <button type="submit" class="btn btn-danger">
            Delete Account
        </button>
    </form>
</section>