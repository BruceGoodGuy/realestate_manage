<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{asset('assets/css/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sidebar-menu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/simplebar.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/apexcharts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/prism.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/rangeslider.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/sweetalert.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/quill.snow.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

    <link rel="icon" type="image/png" href="{{asset('assets/images/favicon.png')}}">

    <title>Dang Chang Group - Login</title>
</head>

<body>
    <x-preloader />
    <div class="container-fluid">
        <div class="main-content d-flex flex-column px-0">

            <div class="m-auto w-100 mw-510 py-5">
                {{ $slot }}
            </div>

        </div>
    </div>


    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/js/dragdrop.js')}}"></script>
    <script src="{{asset('assets/js/rangeslider.min.js')}}"></script>
    <script src="{{asset('assets/js/sweetalert.js')}}"></script>
    <script src="{{asset('assets/js/quill.min.js')}}"></script>
    <script src="{{asset('assets/js/data-table.js')}}"></script>
    <script src="{{asset('assets/js/prism.js')}}"></script>
    <script src="{{asset('assets/js/clipboard.min.js')}}"></script>
    <script src="{{asset('assets/js/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/simplebar.min.js')}}"></script>
    <script src="{{asset('assets/js/fslightbox.js')}}"></script>
    <script src="{{asset('assets/js/custom/custom.js')}}"></script>
</body>

</html>
