@extends('admin.main')
@section('content')
<div class="container-full">
    <!-- ... Header ... -->
    
    <section class="content">
        <div class="row">
            <div class="col-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sub-SubCategory List</h3>
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SubCategory (Parent)</th>
                                    <th>Name</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subsubcategories as $subsubcategory)
                                <tr>
                                    <td>{{ $subsubcategory->subCategory->name ?? 'N/A' }}</td>
                                    <td>{{ $subsubcategory->name }}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a href="{{ route('admin.subsubcategories.edit', $subsubcategory->id) }}"
                                                class="btn btn-primary mr-2">
                                                <i class="fa fa-pencil mr-1"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.subsubcategories.destroy', $subsubcategory->id) }}"
                                            method="POST" class="m-0 delete-form">
                                                @csrf @method('DELETE')
                                                <button type="button" class="btn btn-danger delete-btn">
                                                    <i class="fa fa-trash mr-1"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="3" class="text-center">No items found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Sub-SubCategory</h3>
                    </div>
                    <div class="box-body">
                        <form method="POST" action="{{ route('admin.subsubcategories.store') }}">
                            @csrf
                            
                            <div class="form-group">
                                <h5>Select Category <span class="text-danger">*</span></h5>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" disabled selected>Choose a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <h5>Select SubCategory <span class="text-danger">*</span></h5>
                                <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                                    <option value="" disabled selected>Choose a subcategory</option>
                                    @foreach($subcategories as $sub)
                                        <option value="{{ $sub->id }}" data-category="{{ $sub->category_id }}">
                                            {{ $sub->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sub_category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <h5>Sub-SubCategory Name <span class="text-danger">*</span></h5>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="text-xs-right">
                                <input type="submit" class="btn btn-rounded btn-primary mb-5"
                                    value="Add New Sub-SubCategory" onclick="this.disabled=true;this.form.submit();">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_id');
        const subCategorySelect = document.getElementById('sub_category_id');
        const allSubCategoryOptions = Array.from(subCategorySelect.options).filter(opt => opt.value !== "");
        subCategorySelect.disabled = true;
        subCategorySelect.innerHTML = '<option value="" disabled selected>Choose a category first...</option>';

        function filterSubcategories() {
            const selectedCategoryId = categorySelect.value;
            if (!selectedCategoryId) {
                subCategorySelect.disabled = true;
                subCategorySelect.innerHTML = '<option value="" disabled selected>Choose a category first...</option>';
                return;
            }
            subCategorySelect.disabled = false;
            subCategorySelect.innerHTML = '<option value="" disabled selected>Choose a subcategory</option>';
            allSubCategoryOptions.forEach(option => {
                if (option.getAttribute('data-category') === selectedCategoryId) {
                    subCategorySelect.appendChild(option);
                }
            });
        }
        categorySelect.addEventListener('change', filterSubcategories);
        filterSubcategories();
    });
</script>
@endsection