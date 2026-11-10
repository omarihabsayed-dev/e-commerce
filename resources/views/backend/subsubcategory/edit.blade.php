@extends('admin.main')
@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Edit Sub-SubCategory</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Sub-SubCategories</li>
                            <li class="breadcrumb-item active" aria-current="page">Edit {{ $subsubcategory->name }}</li>
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
                        <h3 class="box-title">Update Sub-SubCategory Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="{{ route('admin.subsubcategories.update', $subsubcategory->id) }}">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <h5>Select Category <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="category_id" id="category_id" class="form-control" required>
                                        <option value="" disabled>Choose a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ old('category_id', $subsubcategory->subCategory->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <h5>Select SubCategory <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                                    </select>
                                    @error('sub_category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <h5>Sub-SubCategory Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name', $subsubcategory->name) }}" required>
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('admin.subsubcategories.index') }}" class="btn btn-secondary">
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categorySelect = document.getElementById('category_id');
        const subCategorySelect = document.getElementById('sub_category_id');
        const currentSubCategoryId = "{{ old('sub_category_id', $subsubcategory->sub_category_id) }}";
        const allSubCategoryOptions = [
            @foreach($subcategories as $sub)
                { id: "{{ $sub->id }}", name: "{{ $sub->name }}", category_id: "{{ $sub->category_id }}" },
            @endforeach
        ];
        function filterSubcategories() {
            const selectedCategoryId = categorySelect.value;
            subCategorySelect.innerHTML = '<option value="" disabled selected>Choose a subcategory</option>'; 
            allSubCategoryOptions.forEach(opt => {
                if (String(opt.category_id) === String(selectedCategoryId)) {
                    const isSelected = (String(opt.id) === String(currentSubCategoryId)) ? 'selected' : '';
                    const optionElement = document.createElement('option');
                    optionElement.value = opt.id;
                    optionElement.textContent = opt.name;
                    if(isSelected) optionElement.selected = true;        
                    subCategorySelect.appendChild(optionElement);
                }
            });
        }
        categorySelect.addEventListener('change', filterSubcategories);
        filterSubcategories();
    });
</script>
@endsection