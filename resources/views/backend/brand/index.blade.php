@extends('admin.main')
@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Brands</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Brands</li>
                            <li class="breadcrumb-item active" aria-current="page">Brand Names</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Brand List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->name }}</td>
                                        <td>
                                            @if($brand->image)
                                            <img src="{{ asset($brand->image) }}" alt="{{ $brand->name }}"
                                                style="max-height: 90px; width: auto; object-fit: contain;">
                                            @else
                                            <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <a href="{{ route('admin.brands.edit', $brand->id) }}"
                                                    class="btn btn-primary mr-2">
                                                    <i class="fa fa-pencil mr-1"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.brands.destroy', $brand->id) }}"
                                                    method="POST" class="m-0 delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger delete-btn">
                                                        <i class="fa fa-trash mr-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No brands found.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->

            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Brand</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('admin.brands.store') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Brand Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="e.g. Nike, Adidas..." value="{{ old('name') }}" required>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Brand Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="file" name="image" class="form-control" accept="image/*" required>
                                        <small class="text-muted">JPG/PNG, max 2MB</small>
                                        @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New Brand"
                                        onclick="this.disabled=true;this.form.submit();">
                                </div>
                            </form>
                        </div>
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