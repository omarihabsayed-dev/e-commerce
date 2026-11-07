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
            <div class="invalid-feedback" style="display: block; color: #dc3545; font-weight: normal; margin-top: 5px;">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="update_password_password" class="font-weight-bold mb-1">New Password</label>
            <input id="update_password_password" name="password" type="password"
                class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                autocomplete="new-password">
            @error('password', 'updatePassword')
            <div class="invalid-feedback" style="display: block; color: #dc3545; font-weight: normal; margin-top: 5px;">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="update_password_password_confirmation" class="font-weight-bold mb-1">Confirm Password</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                autocomplete="new-password">
            @error('password_confirmation', 'updatePassword')
            <div class="invalid-feedback" style="display: block; color: #dc3545; font-weight: normal; margin-top: 5px;">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="d-flex align-items-center mt-4">
            <button type="submit" class="btn btn-primary px-4" style="box-shadow: none; outline: none;">Save</button>

            @if (session('status') === 'password-updated')
            <span class="text-success ml-3" style="margin-left: 10px;">Saved.</span>
            @endif
        </div>
    </form>
</section>