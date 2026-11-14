@extends('admin.main')
@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Slider</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Slider</li>
                            <li class="breadcrumb-item active" aria-current="page">Manage Slider</li>
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
                        <h3 class="box-title">All Sliders</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="15%">Image</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th class="text-center" width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sliders as $slider)
                                    <tr>
                                        <td>
                                            @if($slider->image)
                                            <img src="{{ asset('storage/' . $slider->image) }}" alt="Slider Image"
                                                style="max-height: 80px; width: auto; object-fit: contain;"
                                                class="rounded">
                                            @else
                                            <span class="text-muted">No image</span>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $slider->title }}</strong><br>
                                            <small class="text-muted">{{ Str::limit($slider->description, 40) }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <form action="{{ route('admin.sliders.toggle-status', $slider->id) }}"
                                                    method="POST" class="m-0">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn p-0 border-0"
                                                        title="Click to toggle status">
                                                        @if($slider->status)
                                                        <span class="badge badge-success">Active</span>
                                                        @else
                                                        <span class="badge badge-secondary">Inactive</span>
                                                        @endif
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                        <td style="white-space: nowrap;">
                                            <div style="display:flex; gap:8px; justify-content:center;">
                                                <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                                    class="btn btn-primary"
                                                    style="height:35px; display:inline-flex; align-items:center; padding:0 15px; font-size:14px;">
                                                    <i class="fa fa-pencil mr-1"></i> Edit
                                                </a>
                                                <form action="{{ route('admin.sliders.destroy', $slider->id) }}"
                                                    method="POST" class="m-0 delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger delete-btn"
                                                        style="height:35px; display:inline-flex; align-items:center; padding:0 15px; font-size:14px;">
                                                        <i class="fa fa-trash mr-1"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">No Sliders found. Add one on
                                            the right!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Slider</h3>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Title <span class="text-danger">*</span></h5>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    required>
                                @error('title') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="form-group">
                                <h5>Description <span class="text-danger">*</span></h5>
                                <textarea name="description" class="form-control"
                                    rows="2">{{ old('description') }}</textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="form-group">
                                <h5>Image <span class="text-danger">*</span></h5>
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                                <small class="text-muted">JPG/PNG, max 2MB</small>
                                @error('image') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add Slider"
                                    onclick="this.disabled=true;this.form.submit();">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection