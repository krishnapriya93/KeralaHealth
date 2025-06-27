<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="{{asset('fav.png')}}" type="image/icon type">
    <title>Kerala Health</title>

    <!-- ========== All CSS files linkup ========= -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/assets/backend/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/backend/css/dataTables.min.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/backend/css/lineicons.css')}}" />
    <link rel="stylesheet" href="{{asset('/assets/backend/css/main.css')}}" />
    <link href="{{asset('/assets/backend/css/custom_1.css')}}" rel="stylesheet" />
    <link href="{{asset('/assets/backend/css/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('/assets/backend/css/uppy.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/backend/css/sweetalert2.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/img_cropper/css/cropper.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/css/custom.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/backend/css/flatpickr.min.css')}}">
</head>

<body>

        <!-- ======== main-wrapper start =========== -->
        <main class="main-wrapper">
             @include('backend.layouts.navbar')

        <main class="py-4">
            @yield('content')
        </main>
    @include('backend.layouts.include_scripts')
    @include('backend.layouts.commonscript')
    @yield('page_scripts')
    @yield('mainscript')
    @include('backend.layouts.htmlfooter_login')


