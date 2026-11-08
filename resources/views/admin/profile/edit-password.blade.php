@extends('admin.main')
@section('content')
<div class="container-full">
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Password</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Password</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Password</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Password</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('admin.password.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="current_password">Current Password</label>
                                <input type="password" id="current_password" name="current_password"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" id="new_password" name="new_password" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="new_password_confirmation">Confirm New Password</label>
                                <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                    class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-rounded btn-primary">Update Password</button>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection