<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="google" content="notranslate"/>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="title" content="Kerala Health Department" >
    <meta name="description" content="The Kerala Health Department is dedicated to ensuring the health and well-being of all citizens through quality healthcare, disease prevention, and health promotion initiatives across the state." >
    <meta name="keywords" content="Kerala Health Department, Kerala health, public health Kerala, healthcare Kerala, disease prevention, health promotion, Kerala government health services" >
    <title>Kerala Health Department</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/assets/frontend/images/fav.png')}}">
    <!-- aAkhil krish -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/bootstrap.min.css')}}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/fontawesome.css')}}">
    <!-- Flaticon -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/flaticon.css')}}">
    <!-- Base Icons -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/pbminfotech-base-icons.css')}}">
    <!-- Themify Icons -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/themify-icons.css')}}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/swiper.min.css')}}">
    <!-- Magnific -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/magnific-popup.css')}}">
    <!-- AOS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/aos.css')}}">
    <!-- Shortcode CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/shortcode.css')}}">
    <!-- Base CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/base.css')}}">
    <!-- Demo Base CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/demo-1.css')}}">
    <!-- Akhil_krish Style CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/style.css?v==1')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/responsive.css')}}">

    <link rel="stylesheet" href="{{ asset('/assets/frontend/css/custom.css')}}">

   

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/fav.png">
    <!-- @php
        $sessionbil = Session::get('bilingual')
    @endphp

    @if($sessionbil == 2)
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Malayalam:wght@100..900&display=swap" rel="stylesheet">
    @endif -->
</head>
<style>
#loader-wrapper {
    position: fixed;
    width: 100%;
    height: 100%;
    background: #fff;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.loader {
    border: 8px solid #f3f3f3;
    border-top: 8px solid #7C9C32;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>
<body>
<div id="loader-wrapper">
    <div class="loader"></div>
</div>

    @yield('content')

</body>
<script>
$('#loader-wrapper').show();
fetch('/')
    .then(response => response.json())
    .then(data => {
        // handle success
    })
    .catch(error => {
        console.error(error);
    })
    .finally(() => {
        $('#loader-wrapper').hide();
    });

</script>
@include('frontend.layouts.include_scripts')
</html>