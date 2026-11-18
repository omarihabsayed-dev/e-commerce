@extends('admin.main')
@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Categories</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category List</li>
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
                        <h3 class="box-title">Category List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table no-border">
                                <thead>
                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 80px"><span class="text-white">Icon</span></th>
                                        <th style="min-width: 200px"><span class="text-white">Category Name</span></th>
                                        <th class="text-right" style="min-width: 150px"><span
                                                class="text-fade">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $category)
                                    <tr>
                                        <td class="pl-20 py-8">
                                            <div class="d-flex align-items-center">
                                                <span class="text-white font-size-24"><i
                                                        class="{{ $category->icon }}"></i></span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="text-white font-weight-600 hover-primary mb-1 font-size-16">
                                                {{ $category->name }}
                                            </a>
                                            <span class="text-fade d-block">Slug: {{ $category->slug }}</span>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                class="waves-effect waves-light btn btn-info btn-circle mx-5">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                                                method="POST" class="d-inline delete-form m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="waves-effect waves-light btn btn-danger btn-circle mx-5 delete-btn">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-fade">No categories found.</td>
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
                        <h3 class="box-title">Add Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="POST" action="{{ route('admin.categories.store') }}">
                                @csrf
                                <div class="form-group">
                                    <h5>Category Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="e.g. Electronics, Clothing..." value="{{ old('name') }}"
                                            required>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <h5>Category Icon <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="icon" class="form-control" value="{{ old('icon') }}"
                                            placeholder="e.g. fa fa-laptop" required>
                                        <small class="text-muted">Use FontAwesome 4 classes</small>

                                        @error('icon')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                        value="Add New Category" onclick="this.disabled=true;this.form.submit();">
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