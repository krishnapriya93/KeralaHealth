<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kerala Health</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:title" content="Admin Templates - Dashboard Templates">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <link rel="shortcut icon" href="{{ asset('/assets/frontdashboardnew/assets/images/favicon.svg')}}">

    <!-- *************
		************ CSS Files *************
	************* -->
    <link rel="stylesheet" href="{{ asset('/assets/frontdashboardnew/assets/fonts/remix/remixicon.css')}}">
    <link rel="stylesheet" href="{{ asset('/assets/frontdashboardnew/assets/css/main.min.css')}}">

    <!-- *************
		************ Vendor Css Files *************
	************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/frontdashboardnew/assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}">
</head>

<body>

    <!-- Loading starts -->
    <div id="loading-wrapper">
        <div class='spin-wrapper'>
            <div class='spin'>
                <div class='inner'></div>
            </div>
            <div class='spin'>
                <div class='inner'></div>
            </div>
            <div class='spin'>
                <div class='inner'></div>
            </div>
            <div class='spin'>
                <div class='inner'></div>
            </div>
            <div class='spin'>
                <div class='inner'></div>
            </div>
            <div class='spin'>
                <div class='inner'></div>
            </div>
        </div>
    </div>
    <!-- Loading ends -->

    <!-- Page wrapper starts -->
    <div class="page-wrapper">

        <!-- App header starts -->
        <div class="app-header d-flex align-items-center">

            <!-- Toggle buttons starts -->
            <div class="d-flex">
                <button class="toggle-sidebar" style="box-shadow: none;">
            <i class="ri-menu-line"></i>
          </button>
                <button class="pin-sidebar">
            <i class="ri-menu-line"></i>
          </button>
            </div>
            <!-- Toggle buttons ends -->

            <!-- App brand starts -->
            <div class="app-brand ms-4">
                <a href="index.html" class="d-lg-block text-white d-none">
            <!-- <img src="assets/images/tu.svg" class="logo" alt=""> -->
            <h5 class="mb-0"> Kerala Health Home</h5>
          </a>
                <a href="index.html" class="d-lg-none d-md-block">
            <img src="{{ asset('/assets/frontdashboardnew/assets/images/tu.svg')}}" class="logo" alt="">
          </a>
            </div>
            <!-- App brand ends -->

            <!-- App header actions starts -->
            <div class="header-actions">

                <!-- Search container starts -->
                <div class="search-container d-lg-block d-none mx-3">
                    <input type="text" class="form-control" id="searchId" placeholder="Search">
                    <i class="ri-search-line"></i>
                </div>
                <!-- Search container ends -->

                <!-- Header actions starts -->
                <div class="d-lg-flex d-none gap-2">

                  
                </div>
                <!-- Header actions ends -->

                <!-- Header user settings starts -->
                <!-- <div class="dropdown ms-2">
                    <a id="userSettings" class="dropdown-toggle d-flex align-items-center" href="#!" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar-box">JB<span class="status busy"></span></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow-lg">
                        <div class="px-3 py-2">
                            <span class="small">Admin</span>
                            <h6 class="m-0">James Bruton</h6>
                        </div>
                        <div class="mx-3 my-2 d-grid">
                            <a href="login.html" class="btn btn-danger">Logout</a>
                        </div>
                    </div>
                </div> -->
                <!-- Header user settings ends -->

            </div>
            <!-- App header actions ends -->

        </div>
        <!-- App header ends -->

         <!-- Main container starts -->
        <div class="main-container">