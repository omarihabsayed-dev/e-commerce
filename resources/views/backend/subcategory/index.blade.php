@extends('admin.main')
@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">SubCategories</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">SubCategories</li>
                            <li class="breadcrumb-item active" aria-current="page">SubCategory List</li>
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
                        <h3 class="box-title">SubCategory List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Parent Category</th>
                                        <th>SubCategory Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subcategories as $subcategory)
                                    <tr>
                                        <td>
                                            <span class="badge badge-primary">
                                                {{ $subcategory->category->name ?? 'N/A' }}
                                            </span>
                                        </td>
                                        <td>{{ $subcategory->name }}</td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}"
                                                    class="btn btn-primary mr-2">
                                                    <i class="fa fa-pencil mr-1"></i> Edit
                                                </a>
                                                <form
                                                    action="{{ route('admin.subcategories.destroy', $subcategory->id) }}"
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
                                        <td colspan="3" class="text-center">No subcategories found.</td>
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
                        <h3 class="box-title">Add SubCategory</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="{{ route('admin.subcategories.store') }}">
                            @csrf

                            <div class="form-group">
                                <h5>Select Category <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="category_id" class="form-control" required>
                                        <option value="" disabled selected>Choose a parent category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id')==$category->id ?
                                            'selected' : '' }}>
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
                                        placeholder="e.g. Smartphones, Laptops..." value="{{ old('name') }}" required>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                    value="Add New SubCategory" onclick="this.disabled=true;this.form.submit();">
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