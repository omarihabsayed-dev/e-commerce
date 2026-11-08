@extends('admin.main')
@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Edit Brand</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Brands</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit {{ $brand->name }}</li>
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
                        <h3 class="box-title">Update Brand Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="{{ route('admin.brands.update', $brand->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <h5>Brand Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $brand->name) }}" required>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Brand Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    @if($brand->image)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $brand->image) }}" alt="{{ $brand->name }}"
                                            style="max-height: 100px; border-radius: 5px;">
                                    </div>
                                    @endif

                                    <input type="file" name="image" class="form-control" accept="image/*">
                                    <small class="text-muted">Leave blank to keep the current image. JPG/PNG, max
                                        2MB</small>
                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary"
                                    onclick="this.disabled=true;this.form.submit();">
                                    <i class="fa fa-save mr-1"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>
@endsection