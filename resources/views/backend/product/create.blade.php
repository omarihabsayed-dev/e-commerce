@extends('admin.main')
@section('content')
<div class="container-full">
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add Product</h4>
            </div>

            <div class="box-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Select Brand <span class="text-danger">*</span></h5>
                                <select name="brand_id" class="form-control" required>
                                    <option value="" disabled selected>Choose a brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Select Category <span class="text-danger">*</span></h5>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" disabled selected>Choose a category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Select SubCategory <span class="text-danger">*</span></h5>
                                <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                                    <option value="" disabled selected>Choose a category first</option>
                                </select>
                                @error('sub_category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Select SubSubCategory <span class="text-danger">*</span></h5>
                                <select name="sub_sub_category_id" id="sub_sub_category_id" class="form-control"
                                    required>
                                    <option value="" disabled selected>Choose a subcategory first</option>
                                </select>
                                @error('sub_sub_category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Product Name <span class="text-danger">*</span></h5>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Product Code <span class="text-danger">*</span></h5>
                                <input type="text" name="product_code" class="form-control"
                                    value="{{ old('product_code') }}" required>
                                @error('product_code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Product Color <span class="text-danger">*</span></h5>
                                <input type="text" name="product_color" class="form-control"
                                    value="{{ old('product_color', 'Blue,Yellow,Black') }}" data-role="tagsinput">
                                @error('product_color')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Product Size <span class="text-danger">*</span></h5>
                                <input type="text" name="product_size" class="form-control"
                                    value="{{ old('product_size', 'Small,Medium,Large') }}" data-role="tagsinput">
                                @error('product_size')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Stock Quantity <span class="text-danger">*</span></h5>
                                <input type="number" name="stock_quantity" class="form-control"
                                    value="{{ old('stock_quantity') }}" required>
                                @error('stock_quantity')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Product Tags <span class="text-danger">*</span></h5>
                                <input type="text" name="tags" class="form-control"
                                    value="{{ old('tags', 'Lorem,Ipsum,Amet') }}" data-role="tagsinput">
                                @error('tags')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Product Price <span class="text-danger">*</span></h5>
                                <input type="number" step="0.01" name="price" class="form-control"
                                    value="{{ old('price') }}" required>
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Discount Price</h5>
                                <input type="number" step="0.01" name="discount_price" class="form-control"
                                    value="{{ old('discount_price') }}">
                                @error('discount_price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Thumbnail <span class="text-danger">*</span></h5>
                                <input type="file" name="thumbnail" class="form-control" required accept="image/*">
                                @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Product Images (Multiple)</h5>
                                <input type="file" name="multi_images[]" class="form-control" multiple accept="image/*">
                                @error('multi_images')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Short Description <span class="text-danger">*</span></h5>
                                <textarea name="short_description" class="form-control" rows="3"
                                    required>{{ old('short_description') }}</textarea>
                                @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Long Description <span class="text-danger">*</span></h5>
                                <textarea name="long_description" class="form-control" rows="3"
                                    required>{{ old('long_description') }}</textarea>
                                @error('long_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="checkbox">
                                <input type="checkbox" id="hot_deals" name="hot_deals" value="1">
                                <label for="hot_deals">Hot Deals</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox">
                                <input type="checkbox" id="featured" name="featured" value="1">
                                <label for="featured">Featured</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox">
                                <input type="checkbox" id="special_offer" name="special_offer" value="1">
                                <label for="special_offer">Special Offer</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="checkbox">
                                <input type="checkbox" id="status" name="status" value="1" checked>
                                <label for="status">Active Status</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-xs-right mt-4">
                        <button type="submit" class="btn btn-rounded btn-primary">Add Product</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<!-- Script for Dependent Dropdowns -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category_id');
        const subCategorySelect = document.getElementById('sub_category_id');
        const subSubCategorySelect = document.getElementById('sub_sub_category_id');

        const allSubCategories = [
            @foreach($subcategories as $sub)
                { id: "{{ $sub->id }}", name: "{{ $sub->name }}", category_id: "{{ $sub->category_id }}" },
            @endforeach
        ];

        const allSubSubCategories = [
            @foreach($subsubcategories as $subsub)
                { id: "{{ $subsub->id }}", name: "{{ $subsub->name }}", sub_category_id: "{{ $subsub->sub_category_id }}" },
            @endforeach
        ];

        categorySelect.addEventListener('change', function () {
            const selectedCategory = this.value;
            subCategorySelect.innerHTML = '<option value="" disabled selected>Choose a subcategory</option>';
            subSubCategorySelect.innerHTML = '<option value="" disabled selected>Choose a subcategory first</option>';

            allSubCategories.forEach(sub => {
                if (sub.category_id === selectedCategory) {
                    const opt = document.createElement('option');
                    opt.value = sub.id;
                    opt.textContent = sub.name;
                    subCategorySelect.appendChild(opt);
                }
            });
        });

        subCategorySelect.addEventListener('change', function () {
            const selectedSubCategory = this.value;
            subSubCategorySelect.innerHTML = '<option value="" disabled selected>Choose a sub-subcategory</option>';

            allSubSubCategories.forEach(subsub => {
                if (subsub.sub_category_id === selectedSubCategory) {
                    const opt = document.createElement('option');
                    opt.value = subsub.id;
                    opt.textContent = subsub.name;
                    subSubCategorySelect.appendChild(opt);
                }
            });
        });
    });
</script>
@endsection