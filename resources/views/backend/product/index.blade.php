@extends('admin.main')
@section('content')
<div class="container-full">
    <!-- Content Header -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title">Products</h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}"><i
                                        class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product List</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">All Products</h3>
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                            <i class="fa fa-plus mr-1"></i> Add New Product
                        </a>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="5%">Image</th>
                                        <th>Product Info</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th class="text-center" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                    <tr>
                                        <td>
                                            @if($product->thumbnail)
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="img"
                                                width="60" class="rounded shadow-sm">
                                            @else
                                            <span class="text-muted">No Img</span>
                                            @endif
                                        </td>

                                        <td>
                                            <strong>{{ $product->name }}</strong><br>
                                            <small class="text-muted">Code: {{ $product->product_code }}</small><br>
                                            <small class="text-muted">Brand: {{ $product->brand->name ?? 'N/A'
                                                }}</small>
                                        </td>

                                        <td>
                                            <span class="badge badge-info">{{ $product->category->name ??
                                                'Uncategorized' }}</span>
                                        </td>

                                        <td>
                                            @if($product->discount_price)
                                            <span class="text-danger font-weight-bold">${{
                                                number_format($product->discount_price, 2) }}</span><br>
                                            <del class="text-muted" style="font-size: 12px;">${{
                                                number_format($product->price, 2) }}</del>
                                            @else
                                            <span class="text-success font-weight-bold">${{
                                                number_format($product->price, 2) }}</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($product->stock_quantity > 0)
                                            <span class="badge badge-primary">{{ $product->stock_quantity }} in
                                                stock</span>
                                            @else
                                            <span class="badge badge-danger">Out of Stock</span>
                                            @endif
                                        </td>

                                        <td>
                                            @if($product->status)
                                            <span class="badge badge-success">Active</span>
                                            @else
                                            <span class="badge badge-secondary">Inactive</span>
                                            @endif

                                            @if($product->featured)
                                            <span class="badge badge-warning">Featured</span>
                                            @endif
                                        </td>

                                        <td>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <a href="{{ route('admin.products.edit', $product->id) }}"
                                                    class="btn btn-primary mr-2">
                                                    <i class="fa fa-pencil mr-1"></i> Edit
                                                </a>
                                                <form action="" method="POST" class="m-0 delete-form">
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
                                        <td colspan="7" class="text-center py-4 text-muted">No products found. Click
                                            "Add New Product" to get started.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($products->hasPages())
                    <div class="box-footer">
                        {{ $products->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>
@endsection