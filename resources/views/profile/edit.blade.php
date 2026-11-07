@extends('frontend.main')

@section('content')
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div style="margin-bottom: 6px;">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                </div>

                <div style="margin-bottom: 6px;">
                    <a href="{{ route('profile.edit') }}#updatePassword" class="btn btn-primary btn-sm btn-block">Change
                        Password</a>
                </div>

                <div style="margin-bottom: 6px;">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm btn-block">Logout</button>
                    </form>
                </div>
            </div>

            <div class="col-md-10 mt-3">
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Profile Information</h5>
                        <small class="text-muted">Update your account's profile information and email address.</small>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card mb-4" id="updatePassword">
                    <div class="card-header">
                        <h5 class="mb-0">Update Password</h5>
                        <small class="text-muted">Ensure your account is using a long, random password to stay
                            secure.</small>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0 text-danger">Delete Account</h5>
                        <small class="text-muted">Once your account is deleted, all of its resources and data will be
                            permanently deleted.</small>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection