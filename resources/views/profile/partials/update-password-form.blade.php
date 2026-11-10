<section>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group mb-3">
            <label for="update_password_current_password" class="font-weight-bold mb-1">Current Password</label>
            <input id="update_password_current_password" name="current_password" type="password"
                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                autocomplete="current-password">
            @error('current_password', 'updatePassword')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="update_password_password" class="font-weight-bold mb-1">New Password</label>
            <input id="update_password_password" name="password" type="password"
                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                autocomplete="new-password">
            @error('password', 'updatePassword')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="update_password_password_confirmation" class="font-weight-bold mb-1">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="d-flex align-items-center mt-4">
            <button type="submit" class="btn btn-primary px-4">Save</button>

            @if (session('status') === 'password-updated')
            <div class="alert alert-success py-1 px-3 mb-0 ml-3" style="font-size: 14px;">
                Password updated successfully.
            </div>
            @endif
        </div>
    </form>
</section>