@extends('frontend.main')
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li style="white-space: nowrap;"><a href="{{ route('index') }}">Home</a></li>
                <li style="white-space: nowrap;"><a
                        href="{{ route('frontend.category', $subcategory->category->slug) }}">{{
                        $subcategory->category->name }}</a></li>
                <li class='active' style="white-space: nowrap;">{{ $subcategory->name }}</li>
            </ul>
        </div>
    </div>
</div>

<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row'>
            <div class='col-md-3 sidebar'>
                @include('frontend.partials.categories')

                <div class="sidebar-module-container">
                    <div class="sidebar-filter">
                        <div class="sidebar-widget wow fadeInUp">
                            <h3 class="section-title">shop by</h3>
                            <div class="widget-header">
                                <h4 class="widget-title">Category</h4>
                            </div>
                            <div class="sidebar-widget-body">
                                <div class="accordion">
                                    @foreach($navCategories->take(8) as $category)
                                    <div class="accordion-group">
                                        <div class="accordion-heading">
                                            <a href="#collapse{{ $category->id }}" data-toggle="collapse"
                                                class="accordion-toggle collapsed">
                                                {{ $category->name }}
                                            </a>
                                        </div>
                                        <div class="accordion-body collapse" id="collapse{{ $category->id }}"
                                            style="height: 0px;">
                                            <div class="accordion-inner">
                                                @if($category->subCategories->count() > 0)
                                                <ul>
                                                    @foreach($category->subCategories as $sub)
                                                    <li>
                                                        <a href="{{ route('frontend.subcategory', $sub->slug) }}">
                                                            {{ $sub->name }}
                                                        </a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @else
                                                <ul>
                                                    <li><span class="text-muted">No subcategories</span></li>
                                                </ul>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget wow fadeInUp outer-top-vs">
                            <h3 class="section-title">Compare products</h3>
                            <div class="sidebar-widget-body">
                                <div class="compare-report">
                                    <p>You have no <span>item(s)</span> to compare</p>
                                </div>
                            </div>
                        </div>

                        @include('frontend.partials.tags')
                        @include('frontend.partials.testimonials')
                    </div>
                </div>
            </div>

            <div class='col-md-9'>
                <div class="clearfix filters-container m-t-10">
                    <div class="row">
                        <div class="col col-sm-6 col-md-2">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                    <li class="active"> <a data-toggle="tab" href="#grid-container"><i
                                                class="icon fa fa-th-large"></i>Grid</a> </li>
                                    <li><a data-toggle="tab" href="#list-container"><i
                                                class="icon fa fa-th-list"></i>List</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-sm-12 col-md-6">
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Sort by</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle">
                                                Position <span class="caret"></span> </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">position</a></li>
                                                <li role="presentation"><a href="#">Price:Lowest first</a></li>
                                                <li role="presentation"><a href="#">Price:HIghest first</a></li>
                                                <li role="presentation"><a href="#">Product Name:A to Z</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-sm-3 col-md-6 no-padding">
                                <div class="lbl-cnt"> <span class="lbl">Show</span>
                                    <div class="fld inline">
                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">
                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1
                                                <span class="caret"></span> </button>
                                            <ul role="menu" class="dropdown-menu">
                                                <li role="presentation"><a href="#">1</a></li>
                                                <li role="presentation"><a href="#">2</a></li>
                                                <li role="presentation"><a href="#">3</a></li>
                                                <li role="presentation"><a href="#">4</a></li>
                                                <li role="presentation"><a href="#">5</a></li>
                                                <li role="presentation"><a href="#">6</a></li>
                                                <li role="presentation"><a href="#">7</a></li>
                                                <li role="presentation"><a href="#">8</a></li>
                                                <li role="presentation"><a href="#">9</a></li>
                                                <li role="presentation"><a href="#">10</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="search-result-container">
                    <div id="myTabContent" class="tab-content category-list">

                        <div class="tab-pane active" id="grid-container">
                            <div class="category-product">
                                <div class="row">
                                    @forelse($products as $product)
                                    <div class="col-sm-6 col-md-4 wow fadeInUp">
                                        <div class="products">
                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{ route('frontend.product', $product->slug) }}">
                                                            <img src="{{ strpos($product->thumbnail, 'http') === 0 ? $product->thumbnail : asset('storage/' . $product->thumbnail) }}"
                                                                alt="{{ $product->name }}">
                                                        </a>
                                                    </div>
                                                    @if($product->created_at->diffInDays(now()) <= 7) <div
                                                        class="tag new"><span>new</span>
                                                </div>
                                                @endif
                                            </div>
                                            <div class="product-info text-left">
                                                <h3 class="name">
                                                    <a href="{{ route('frontend.product', $product->slug) }}">{{
                                                        $product->name }}</a>
                                                </h3>
                                                <div class="rating rateit-small"></div>
                                                <div class="description"></div>
                                                <div class="product-price">
                                                    @if($product->discount_price && $product->discount_price > 0)
                                                    <span class="price"> ${{ number_format($product->discount_price, 2)
                                                        }} </span>
                                                    <span class="price-before-discount">${{
                                                        number_format($product->price, 2) }}</span>
                                                    @else
                                                    <span class="price"> ${{ number_format($product->price, 2) }}
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="cart clearfix animate-effect">
                                                <div class="action">
                                                    <ul class="list-unstyled">
                                                        <li class="add-cart-button btn-group">
                                                            <button class="btn btn-primary icon" data-toggle="dropdown"
                                                                type="button"> <i class="fa fa-shopping-cart"></i>
                                                            </button>
                                                            <button class="btn btn-primary cart-btn" type="button">Add
                                                                to cart</button>
                                                        </li>
                                                        <li class="lnk wishlist"> <a class="add-to-cart" href="#"
                                                                title="Wishlist"> <i class="icon fa fa-heart"></i> </a>
                                                        </li>
                                                        <li class="lnk"> <a class="add-to-cart" href="#"
                                                                title="Compare"> <i class="fa fa-signal"></i> </a> </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <h4>No products found in this subcategory.</h4>
                                </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="list-container">
                        <div class="category-product">
                            @forelse($products as $product)
                            <div class="category-product-inner wow fadeInUp">
                                <div class="products">
                                    <div class="product-list product">
                                        <div class="row product-list-row">
                                            <div class="col col-sm-4 col-lg-4">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a href="{{ route('frontend.product', $product->slug) }}">
                                                            <img src="{{ strpos($product->thumbnail, 'http') === 0 ? $product->thumbnail : asset('storage/' . $product->thumbnail) }}"
                                                                alt="{{ $product->name }}">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col col-sm-8 col-lg-8">
                                                <div class="product-info">
                                                    <h3 class="name">
                                                        <a href="{{ route('frontend.product', $product->slug) }}">{{
                                                            $product->name }}</a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="product-price">
                                                        @if($product->discount_price && $product->discount_price > 0)
                                                        <span class="price"> ${{ number_format($product->discount_price,
                                                            2) }} </span>
                                                        <span class="price-before-discount">${{
                                                            number_format($product->price, 2) }}</span>
                                                        @else
                                                        <span class="price"> ${{ number_format($product->price, 2) }}
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="description m-t-10">
                                                        {{ \Illuminate\Support\Str::limit($product->short_description,
                                                        150) }}
                                                    </div>
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <button class="btn btn-primary icon"
                                                                        data-toggle="dropdown" type="button"> <i
                                                                            class="fa fa-shopping-cart"></i> </button>
                                                                    <button class="btn btn-primary cart-btn"
                                                                        type="button">Add to cart</button>
                                                                </li>
                                                                <li class="lnk wishlist"> <a class="add-to-cart"
                                                                        href="#" title="Wishlist"> <i
                                                                            class="icon fa fa-heart"></i> </a> </li>
                                                                <li class="lnk"> <a class="add-to-cart" href="#"
                                                                        title="Compare"> <i class="fa fa-signal"></i>
                                                                    </a> </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($product->created_at->diffInDays(now()) <= 7) <div class="tag new">
                                            <span>new</span>
                                    </div>
                                    @elseif($product->discount_price && $product->discount_price > 0)
                                    <div class="tag sale"><span>sale</span></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-12">
                            <h4>No products found in this subcategory.</h4>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

            <div class="clearfix filters-container">
                <div class="text-right">
                    <div class="pagination-container">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('frontend.partials.brands')

</div>
</div>
@endsection