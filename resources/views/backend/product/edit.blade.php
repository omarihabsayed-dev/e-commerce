@extends('admin.main')
@section('content')
<div class="container-full">
    <section class="content">
        <div class="box">
            <div class="box-header with-border d-flex justify-content-between align-items-center">
                <h4 class="box-title">Edit Product</h4>
                <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                    <i class="fa fa-arrow-left mr-1"></i> Back to Products
                </a>
            </div>
            <div class="box-body">
                <form method="POST" action="{{ route('admin.products.update', $product->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Select Brand <span class="text-danger">*</span></h5>
                                <select name="brand_id" class="form-control" required>
                                    <option value="" disabled>Choose a brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) ==
                                        $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Select Category <span class="text-danger">*</span></h5>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" disabled>Choose a category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) ==
                                        $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Select SubCategory <span class="text-danger">*</span></h5>
                                <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                                </select>
                                @error('sub_category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <h5>Select SubSubCategory <span class="text-danger">*</span></h5>
                                <select name="sub_sub_category_id" id="sub_sub_category_id" class="form-control"
                                    required>
                                </select>
                                @error('sub_sub_category_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Product Name <span class="text-danger">*</span></h5>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $product->name) }}" required>
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Product Code <span class="text-danger">*</span></h5>
                                <input type="text" name="product_code" class="form-control"
                                    value="{{ old('product_code', $product->product_code) }}" required>
                                @error('product_code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Product Color</h5>
                                <input type="text" name="product_color" class="form-control"
                                    value="{{ old('product_color', $product->product_color) }}" data-role="tagsinput">
                                @error('product_color')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Product Size</h5>
                                <input type="text" name="product_size" class="form-control"
                                    value="{{ old('product_size', $product->product_size) }}" data-role="tagsinput">
                                @error('product_size')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Stock Quantity <span class="text-danger">*</span></h5>
                                <input type="number" name="stock_quantity" class="form-control"
                                    value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                                @error('stock_quantity')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Product Tags</h5>
                                <input type="text" name="tags" class="form-control"
                                    value="{{ old('tags', $product->tags) }}" data-role="tagsinput">
                                @error('tags')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Product Price <span class="text-danger">*</span></h5>
                                <input type="number" step="0.01" name="price" class="form-control"
                                    value="{{ old('price', $product->price) }}" required>
                                @error('price')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Discount Price</h5>
                                <input type="number" step="0.01" name="discount_price" id="discount_price"
                                    class="form-control"
                                    value="{{ old('discount_price', $product->discount_price ?? '') }}">
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
                                <input type="file" name="thumbnail" class="form-control" accept="image/*">
                                <small class="text-muted">Leave blank to keep current image.</small>
                                @error('thumbnail')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Product Images (Multiple)</h5>
                                <input type="file" name="multi_images[]" class="form-control" multiple accept="image/*">
                                <small class="text-muted">Upload new images to add to the gallery.</small>
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
                                    required>{{ old('short_description', $product->short_description) }}</textarea>
                                @error('short_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <h5>Long Description <span class="text-danger">*</span></h5>
                                <textarea name="long_description" class="form-control" rows="3"
                                    required>{{ old('long_description', $product->long_description) }}</textarea>
                                @error('long_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="hot_deals" name="hot_deals"
                                    value="1" {{ old('hot_deals', $product->hot_deals) ? 'checked' : '' }}>
                                <label class="form-check-label" for="hot_deals">Hot Deals</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1"
                                    {{ old('featured', $product->featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">Featured</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="special_offer" name="special_offer"
                                    value="1" {{ old('special_offer', $product->special_offer) ? 'checked' : '' }}>
                                <label class="form-check-label" for="special_offer">Special Offer</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="status" name="status" value="1" {{
                                    old('status', $product->status) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status">Active Status</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-primary">Update Product</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category_id');
        const subCategorySelect = document.getElementById('sub_category_id');
        const subSubCategorySelect = document.getElementById('sub_sub_category_id');

        const currentCategoryId = "{{ $product->category_id }}";
        const currentSubCategoryId = "{{ $product->sub_category_id }}";
        const currentSubSubCategoryId = "{{ $product->sub_sub_category_id }}";

        const allSubCategories = [
            @foreach($subcategories as $sub)
                { id: "{{ $sub->id }}", name: "{!! addslashes($sub->name) !!}", category_id: "{{ $sub->category_id }}" },
            @endforeach
        ];

        const allSubSubCategories = [
            @foreach($subsubcategories as $subsub)
                { id: "{{ $subsub->id }}", name: "{!! addslashes($subsub->name) !!}", sub_category_id: "{{ $subsub->sub_category_id }}" },
            @endforeach
        ];

        function loadSubCategories(selectedCatId, selectedSubId) {
            subCategorySelect.innerHTML = '<option value="" disabled>Choose a subcategory</option>';
            subCategorySelect.disabled = false;

            allSubCategories.forEach(sub => {
                if (String(sub.category_id) === String(selectedCatId)) {
                    const opt = document.createElement('option');
                    opt.value = sub.id;
                    opt.innerHTML = sub.name;
                    if (String(sub.id) === String(selectedSubId)) opt.selected = true;
                    subCategorySelect.appendChild(opt);
                }
            });
        }

        function loadSubSubCategories(selectedSubId, selectedSubSubId) {
            subSubCategorySelect.innerHTML = '<option value="" disabled>Choose a sub-subcategory</option>';
            subSubCategorySelect.disabled = false;

            allSubSubCategories.forEach(subsub => {
                if (String(subsub.sub_category_id) === String(selectedSubId)) {
                    const opt = document.createElement('option');
                    opt.value = subsub.id;
                    opt.innerHTML = subsub.name;
                    if (String(subsub.id) === String(selectedSubSubId)) opt.selected = true;
                    subSubCategorySelect.appendChild(opt);
                }
            });
        }

        if (currentCategoryId) {
            loadSubCategories(currentCategoryId, currentSubCategoryId);
        }
        if (currentSubCategoryId) {
            loadSubSubCategories(currentSubCategoryId, currentSubSubCategoryId);
        }

        categorySelect.addEventListener('change', function () {
            const selectedCategory = this.value;
            subCategorySelect.innerHTML = '<option value="" disabled selected>Choose a subcategory</option>';
            subSubCategorySelect.innerHTML = '<option value="" disabled selected>Choose a subcategory first</option>';
            subSubCategorySelect.disabled = true;

            if (selectedCategory) {
                loadSubCategories(selectedCategory, null);
            }
        });

        subCategorySelect.addEventListener('change', function () {
            const selectedSubCategory = this.value;
            subSubCategorySelect.innerHTML = '<option value="" disabled selected>Choose a sub-subcategory</option>';

            if (selectedSubCategory) {
                loadSubSubCategories(selectedSubCategory, null);
            }
        });

        const discountInput = document.getElementById('discount_price');
        if (discountInput) {
            discountInput.addEventListener('focus', function () {
                if (this.value == 0 || this.value == '0.00') {
                    this.value = '';
                }
            });
        }
    });
</script>
@endsection