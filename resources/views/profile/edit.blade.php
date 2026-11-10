@extends('frontend.main')

@section('content')
<div class="body-content">
    <div class="container mt-4">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-md-3 col-lg-2 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body p-2">
                        <a href="{{ route('profile.edit') }}"
                            class="btn btn-primary btn-sm btn-block mb-2 {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
                            Profile Update
                        </a>

                        <a href="{{ route('profile.edit') }}#updatePassword"
                            class="btn btn-outline-primary btn-sm btn-block mb-2">
                            Change Password
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm btn-block">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Main Content --}}
            <div class="col-md-9 col-lg-10">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Profile Information</h5>
                        <small class="text-muted">Update your account's profile information and email address.</small>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="card shadow-sm mb-4" id="updatePassword">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Update Password</h5>
                        <small class="text-muted">Ensure your account is using a long, random password to stay
                            secure.</small>
                    </div>
                    <div class="card-body">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="card shadow-sm mb-4 border-danger">
                    <div class="card-header bg-white">
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