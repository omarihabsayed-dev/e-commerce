@extends('admin.main')
@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Edit Category</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Categories</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit {{ $category->name }}</li>
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
                        <h3 class="box-title">Update Category Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="{{ route('admin.categories.update', $category->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <h5>Category Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $category->name) }}" required>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Category Icon <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="icon" class="form-control"
                                        value="{{ old('icon', $category->icon) }}" required
                                        placeholder="e.g. fa fa-laptop">
                                    <small class="text-muted">Use FontAwesome 4 classes</small>
                                    @error('icon')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
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