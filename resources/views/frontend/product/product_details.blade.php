@extends('frontend.main')
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li style="white-space: nowrap;"><a href="{{ route('index') }}">Home</a></li>

                @if($product->category)
                <li style="white-space: nowrap;">
                    <a href="{{ route('frontend.category', $product->category->slug) }}">{{ $product->category->name
                        }}</a>
                </li>
                @endif

                @if($product->subCategory)
                <li style="white-space: nowrap;">
                    <a href="{{ route('frontend.subcategory', $product->subCategory->slug) }}">{{
                        $product->subCategory->name
                        }}</a>
                </li>
                @endif

                @if($product->subSubCategory)
                <li style="white-space: nowrap;">
                    <a href="{{ route('frontend.subsubcategory', $product->subSubCategory->slug) }}">{{
                        $product->subSubCategory->name }}</a>
                </li>
                @endif

                <li class='active' style="white-space: nowrap;">{{ $product->name }}</li>
            </ul>
        </div>
    </div>
</div>

<div class="body-content outer-top-xs">
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-9'>
                <div class="detail-block">
                    <div class="row wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">
                                <div id="owl-single-product">
                                    <div class="single-product-gallery-item" id="slide1">
                                        <a data-lightbox="image-1" data-title="{{ $product->name }}"
                                            href="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('storage/' . $product->thumbnail) }}">
                                            <img class="img-responsive" alt="{{ $product->name }}"
                                                src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('storage/' . $product->thumbnail) }}" />
                                        </a>
                                    </div>

                                    @foreach($product->images as $key => $image)
                                    <div class="single-product-gallery-item" id="slide{{ $key + 2 }}">
                                        <a data-lightbox="image-1" data-title="{{ $product->name }}"
                                            href="{{ asset('storage/' . $image->image_path) }}">
                                            <img class="img-responsive" alt="{{ $product->name }}"
                                                src="{{ asset('storage/' . $image->image_path) }}" />
                                        </a>
                                    </div>
                                    @endforeach
                                </div>

                                <div class="single-product-gallery-thumbs gallery-thumbs">
                                    <div id="owl-single-product-thumbnails">
                                        <div class="item">
                                            <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                data-slide="1" href="#slide1">
                                                <img class="img-responsive" width="85" alt=""
                                                    src="{{ Str::startsWith($product->thumbnail, 'http') ? $product->thumbnail : asset('storage/' . $product->thumbnail) }}" />
                                            </a>
                                        </div>

                                        @foreach($product->images as $key => $image)
                                        <div class="item">
                                            <a class="horizontal-thumb" data-target="#owl-single-product"
                                                data-slide="{{ $key + 2 }}" href="#slide{{ $key + 2 }}">
                                                <img class="img-responsive" width="85" alt=""
                                                    src="{{ asset('storage/' . $image->image_path) }}" />
                                            </a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name">{{ $product->name }}</h1>

                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="rating rateit-small"></div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="reviews">
                                                <a href="#" class="lnk">(0 Reviews)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="stock-box">
                                                <span class="label">Availability :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                @if($product->stock_quantity > 0)
                                                <span class="value text-success">In Stock ({{ $product->stock_quantity
                                                    }})</span>
                                                @else
                                                <span class="value text-danger">Out of Stock</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="description-container m-t-20">
                                    {!! $product->short_description !!}
                                </div>

                                <div class="price-container info-container m-t-20">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                @if($product->discount_price && $product->discount_price > 0)
                                                @php
                                                $discountPercentage = round((($product->price -
                                                $product->discount_price) / $product->price) * 100);
                                                @endphp
                                                <span class="price">${{ number_format($product->discount_price, 2)
                                                    }}</span>
                                                <span class="price-strike">${{ number_format($product->price, 2)
                                                    }}</span>
                                                <span class="badge badge-danger ml-2">-{{ $discountPercentage }}%</span>
                                                @else
                                                <span class="price">${{ number_format($product->price, 2) }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <a class="btn btn-primary" data-toggle="tooltip" title="Wishlist"
                                                    href="#"><i class="fa fa-heart"></i></a>
                                                <a class="btn btn-primary" data-toggle="tooltip" title="Add to Compare"
                                                    href="#"><i class="fa fa-signal"></i></a>
                                                <a class="btn btn-primary" data-toggle="tooltip" title="E-mail"
                                                    href="#"><i class="fa fa-envelope"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="quantity-container info-container">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <span class="label">Qty :</span>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="cart-quantity">
                                                <div class="quant-input">
                                                    <div class="arrows">
                                                        <div class="arrow plus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-asc"></i></span></div>
                                                        <div class="arrow minus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-desc"></i></span></div>
                                                    </div>
                                                    <input type="text" value="1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-7">
                                            <button type="button" class="btn btn-primary"><i
                                                    class="fa fa-shopping-cart inner-right-vs"></i> ADD TO CART</button>
                                        </div>
                                    </div>
                                </div>

                                @if($product->product_color || $product->product_size)
                                <div class="m-t-20">
                                    <div class="row">

                                        @if($product->product_color)
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="info-title control-label">Color <span>*</span></label>
                                                <select class="form-control unicase-form-control">
                                                    <option selected>--Select Color--</option>
                                                    @foreach(explode(',', $product->product_color) as $color)
                                                    <option value="{{ trim($color) }}">{{ trim($color) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                        @if($product->product_size)
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="info-title control-label">Size <span>*</span></label>
                                                <select class="form-control unicase-form-control">
                                                    <option selected>--Select Size--</option>
                                                    @foreach(explode(',', $product->product_size) as $size)
                                                    <option value="{{ trim($size) }}">{{ trim($size) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-tabs inner-bottom-xs wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">DESCRIPTION</a></li>
                                <li><a data-toggle="tab" href="#review">REVIEW</a></li>
                                <li><a data-toggle="tab" href="#tags">TAGS</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-9">
                            <div class="tab-content">
                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        {!! $product->long_description !!}
                                    </div>
                                </div>
                                <div id="review" class="tab-pane">
                                    <div class="product-tab">
                                        <h4 class="title">Customer Reviews</h4>
                                        <p>No reviews yet.</p>
                                    </div>
                                </div>
                                <div id="tags" class="tab-pane">
                                    <div class="product-tag">
                                        <h4 class="title">Product Tags</h4>
                                        <div class="form-container">
                                            <div class="form-group" style="display: flex; flex-wrap: wrap; gap: 10px;">

                                                @if($product->tags)
                                                @php
                                                $tags = explode(',', $product->tags);
                                                @endphp

                                                @foreach($tags as $tag)
                                                @php
                                                $cleanTag = trim($tag);
                                                @endphp
                                                <a href="{{ route('frontend.tag', urlencode($cleanTag)) }}"
                                                    class="btn btn-default btn-sm"
                                                    style="background: #f4f4f4; border: 1px solid #ddd; border-radius: 20px; padding: 8px 15px; color: #555;">
                                                    #{{ $cleanTag }}
                                                </a>
                                                @endforeach
                                                @else
                                                <span class="text-muted">No tags available for this product.</span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <section class="section featured-product wow fadeInUp">
                    <h3 class="section-title">Related products</h3>
                    <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs">
                        @forelse($relatedProducts as $related)
                        <div class="item item-carousel">
                            <div class="products">
                                <div class="product">
                                    <div class="product-image">
                                        <div class="image">
                                            <a href="{{ route('frontend.product', $related->slug) }}">
                                                <img src="{{ Str::startsWith($related->thumbnail, 'http') ? $related->thumbnail : asset('storage/' . $related->thumbnail) }}"
                                                    alt="{{ $related->name }}">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product-info text-left">
                                        <h3 class="name"><a href="{{ route('frontend.product', $related->slug) }}">{{
                                                $related->name }}</a></h3>
                                        <div class="product-price">
                                            @if($related->discount_price && $related->discount_price > 0)
                                            <span class="price">${{ number_format($related->discount_price, 2) }}</span>
                                            <span class="price-before-discount">${{ number_format($related->price, 2)
                                                }}</span>
                                            @else
                                            <span class="price">${{ number_format($related->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <p>No related products found.</p>
                        @endforelse
                    </div>
                </section>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
@endsection