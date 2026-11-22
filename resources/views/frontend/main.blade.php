<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>Flipmart premium HTML5 & CSS3 Template</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    @include('frontend.partials.header')

    <!-- ============================================== HEADER : END ============================================== -->
    @yield('content')
    <!-- /#top-banner-and-menu -->

    <!-- ============================================================= FOOTER ============================================================= -->
    @include('frontend.partials.footer')
    <!-- ============================================================= FOOTER : END============================================================= -->

    <!-- For demo purposes – can be removed on production -->

    <!-- For demo purposes – can be removed on production : End -->

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document"
            style="width: 800px !important; max-width: 95%; margin: 30px auto !important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><strong id="name"></strong></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">

                                <img src="" class="card-img-top" alt="" style="height: 200px; width: 200px;"
                                    id="thumbnail">
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">Product Price: <strong class="text-danger">$<span
                                            id="pprice"></span></strong> <del id="oldPrice">$</del></li>
                                <li class="list-group-item">Product Code: <strong id="code"></strong></li>
                                <li class="list-group-item">Category: <strong id="category"></strong></li>
                                <li class="list-group-item">Brand: <strong id="brand"></strong></li>
                                <li class="list-group-item">Stock: <span class="badge badge-pill badge-success"
                                        id="available"></span> <span class="badge badge-pill badge-success"
                                        id="out"></span></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="colorArea">
                                <label for="color">Choose Color</label>
                                <select class="form-control" id="color" name="color">
                                </select>
                            </div>
                            <div class="form-group" id="sizeArea">
                                <label for="size">Choose Size</label>
                                <select class="form-control" id="size" name="size">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" value="1" min="1">
                            </div>
                            <input type="hidden" id="productId">
                            <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to
                                Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        function productView(id) {
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'JSON',
                success: function (data) {
                    $('#name').text(data.product.name);
                    $('#code').text(data.product.product_code);
                    $('#category').text(data.product.category.name);
                    $('#brand').text(data.product.brand.name);
                    $('#stock').text(data.product.stock_quantity);
                    $('#thumbnail').attr('src', data.product.thumbnail);
                    $('#productId').val(id);
                    $('#quantity').val(1);



                    if (data.product.price && data.product.discount_price > 0) {
                        $('#pprice').text(data.product.discount_price);
                        $('#oldPrice').text(data.product.price).show();
                    } else {
                        $('#pprice').text(data.product.price);
                        $('#oldPrice').text(data.product.discount_price).hide();

                    }

                    if (data.product.stock_quantity && data.product.stock_quantity > 0) {
                        $('#available').text('Available').show();
                        $('#out').text('Out of Stock').hide();

                    } else {
                        $('#out').text('Out of Stock').show();
                        $('#available').text('Available').hide();
                    }

                    $('select[name="color"]').empty();
                    $('select[name="color"]').append('<option value="" selected disabled>--Select Color--</option>');
                    if (data.product.product_color) {
                        let colors = data.product.product_color.split(',');
                        $.each(colors, function (key, value) {
                            $('select[name="color"]').append('<option value="' + value.trim() + '">' + value.trim() + '</option>');
                        });
                    } else {
                        $('#colorArea').hide();

                    }

                    $('select[name="size"]').empty();
                    $('select[name="size"]').append('<option value="" selected disabled>--Select Size--</option>');
                    if (data.product.product_size) {
                        let size = data.product.product_size.split(',');
                        $.each(size, function (key, value) {
                            $('select[name="size"]').append('<option value="' + value.trim() + '">' + value.trim() + '</option>');
                        });
                    } else {
                        $('#sizeArea').hide();
                    }
                }
            })
        }

        function addToCart() {
            var product_name = $('#name').text();
            var id = $('#productId').val();
            var color = $('#color option:selected').text();
            var size = $('#size option:selected').text();
            var quantity = $('#quantity').val();
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                data: {
                    color: color, size: size, quantity: quantity, product_name: product_name
                },
                url: '/cart/data/store/' + id,
                success: function (data) {
                    $('#closeModal').click();
                }
            })
        }
    </script>
</body>

</html>