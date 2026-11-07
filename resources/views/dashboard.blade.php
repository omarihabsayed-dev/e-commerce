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
            <div class="col-md-6 mt-3">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hi... </span><strong>{{ Auth::user()->name
                            }}</strong> Welcome to Easy Online Shop</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection