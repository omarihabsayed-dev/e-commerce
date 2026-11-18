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
                            <table class="table no-border">
                                <thead>
                                    <tr class="text-uppercase bg-lightest">
                                        <th style="min-width: 250px"><span class="text-white">Product</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Price</span></th>
                                        <th style="min-width: 100px"><span class="text-fade">Stock</span></th>
                                        <th style="min-width: 150px"><span class="text-fade">Category</span></th>
                                        <th style="min-width: 130px"><span class="text-fade">Status</span></th>
                                        <th style="min-width: 120px" class="text-right"><span
                                                class="text-fade">Action</span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                    <tr>
                                        <td class="pl-0 py-8">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 mr-20">
                                                    <div class="bg-img h-50 w-50"
                                                        style="background-image: url({{ strpos($product->thumbnail, 'http') === 0 ? $product->thumbnail : asset('storage/' . $product->thumbnail) }}); background-size: cover; border-radius: 5px;">
                                                    </div>
                                                </div>

                                                <div>
                                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                                        class="text-white font-weight-600 hover-primary mb-1 font-size-16">
                                                        {{ $product->name }}
                                                    </a>
                                                    <span class="text-fade d-block">
                                                        Code: {{ $product->product_code }} | Brand: {{
                                                        $product->brand->name ?? 'N/A' }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($product->discount_price && $product->discount_price > 0)
                                            <span class="text-danger font-weight-600 d-block font-size-16">
                                                ${{ number_format($product->discount_price, 2) }}
                                            </span>
                                            <del class="text-fade d-block font-size-14">
                                                ${{ number_format($product->price, 2) }}
                                            </del>
                                            @else
                                            <span class="text-white font-weight-600 d-block font-size-16">
                                                ${{ number_format($product->price, 2) }}
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->stock_quantity > 0)
                                            <span class="text-white font-weight-600 d-block font-size-16">
                                                {{ $product->stock_quantity }}
                                            </span>
                                            @else
                                            <span class="text-danger font-weight-600 d-block font-size-16">
                                                Out of Stock
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-fade font-weight-600 d-block font-size-16">
                                                {{ $product->category->name ?? 'Uncategorized' }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.products.toggle-status', $product->id) }}"
                                                method="POST" class="m-0">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-link p-0 border-0"
                                                    title="Click to toggle status">
                                                    @if($product->status)
                                                    <span class="badge badge-success-light badge-lg">Active</span>
                                                    @else
                                                    <span class="badge badge-danger-light badge-lg">Inactive</span>
                                                    @endif
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="waves-effect waves-light btn btn-info btn-circle mx-5">
                                                <span class="mdi mdi-pencil"></span>
                                            </a>

                                            <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                method="POST" class="d-inline delete-form m-0">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button"
                                                    class="waves-effect waves-light btn btn-danger btn-circle mx-5 delete-btn">
                                                    <span class="mdi mdi-delete"></span>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4 text-fade">No products found.</td>
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