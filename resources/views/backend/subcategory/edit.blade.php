@extends('admin.main')
@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Edit SubCategory</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">SubCategories</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit {{ $subcategory->name }}</li>
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
                        <h3 class="box-title">Update SubCategory Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="{{ route('admin.subcategories.update', $subcategory->id) }}">
                            @csrf
                            @method('PATCH')

                            <div class="form-group">
                                <h5>Select Category <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="category_id" class="form-control" required>
                                        <option value="" disabled>Choose a parent category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $subcategory->
                                            category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>SubCategory Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $subcategory->name) }}" required>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">
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