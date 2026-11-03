@extends('admin.main')
@section('content')
<div class="container-full">

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Edit Profile</h4>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $admin->name }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    value="{{ $admin->email }}" required>
                            </div>

                            <button type="submit" class="btn btn-rounded btn-primary">Update Profile</button>
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