<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="form-group mb-3">
            <label for="name" class="font-weight-bold mb-1">Name</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email" class="font-weight-bold mb-1">Email</label>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
            <div class="mt-2">
                <p class="text-sm text-muted mb-1">
                    Your email address is unverified.
                    <button form="send-verification" class="btn btn-link p-0 align-baseline" style="font-size: 14px;">
                        Click here to re-send the verification email.
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <div class="alert alert-success py-2 mt-2">
                    A new verification link has been sent to your email address.
                </div>
                @endif
            </div>
            @endif
        </div>

        <div class="d-flex align-items-center mt-4">
            <button type="submit" class="btn btn-primary px-4">Save</button>

            @if (session('status') === 'profile-updated')
            <span class="text-success ml-3" style="margin-left: 10px; box-shadow: none; outline: none;">Saved.</span>
            @endif
        </div>
    </form>
</section>