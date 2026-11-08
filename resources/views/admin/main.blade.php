<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        /* Prevent theme CSS from turning Toastr notifications white */
        #toast-container>.toast {
            background-image: none !important;
            opacity: 1 !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        }

        #toast-container>.toast-success {
            background-color: #05b993 !important;
            color: #ffffff !important;
        }

        #toast-container>.toast-error {
            background-color: #fc4b6c !important;
            color: #ffffff !important;
        }

        #toast-container>.toast-info {
            background-color: #1e88e5 !important;
            color: #ffffff !important;
        }

        #toast-container>.toast-warning {
            background-color: #ffb22b !important;
            color: #ffffff !important;
        }
    </style>

    <title>E-Commerce Admin - Dashboard</title>

    <!-- Vendors Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">

    <!-- Style-->
    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">

</head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">

    <div class="wrapper">

        @include('admin.partials.header')

        <!-- Left side column. contains the logo and sidebar -->
        @include('admin.partials.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        @include('admin.partials.footer')

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>

    </div>
    <!-- ./wrapper -->


    <!-- 1. jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- 2. Vendor & Admin Template Scripts -->
    <script src="{{ asset('backend/js/vendors.min.js') }}"></script>
    <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
    <script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>

    <script src="{{ asset('backend/js/template.js') }}"></script>
    <script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>

    <!-- 3. Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- 4. Toastr Session Logic -->
    <script>
        @if (Session:: has('success'))
        toastr.success("{{ Session::get('success') }}");
        @endif

        @if (Session:: has('error'))
        toastr.error("{{ Session::get('error') }}");
        @endif

        @if (Session:: has('info'))
        toastr.info("{{ Session::get('info') }}");
        @endif

        @if (Session:: has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
        @endif
    </script>

    <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function () {
            $('.delete-btn').on('click', function (e) {
                e.preventDefault();
                var form = $(this).closest('.delete-form');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form[0].submit();
                    }
                });
            });
        });
    </script>

</body>

</html>