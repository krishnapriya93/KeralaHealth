@extends('frontend.layouts.main_header')

@section('content')
<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    <header class="site-header header-style-2">
        <div class="top-head pbmit-pre-header-wrapper pbmit-bg-color-global">
            <div class="container-fluid">
                <div class="d-flex justify-content-between">
                    <div class="pbmit-pre-header-left">
                        <ul class="pbmit-contact-info">
                            <li><i class="pbmit-base-icon-marker"></i>{{  App\Http\Controllers\FrontendController::getSiteControlLabel('location') ?? 'Kerala Health, Government Secretariat' }} </li>
                            <li><i class="pbmit-base-icon-contact"></i>{{  App\Http\Controllers\FrontendController::getSiteControlLabel('gmailid') ?? 'keralahealth@xxxx.com' }}</li>
                        </ul>
                    </div>
                    <div class="pbmit-pre-header-right">
                        <ul class="pbmit-social-links">
                            <li>
                               <img class="pbmit-sticky-logo" src="{{asset('assets/frontend/images/langmal.svg')}}" alt="keralahealth">
                                @if(isset($sessionbil) && $sessionbil == 2)
                                    <button  type="button" data-mdb-button-init data-mdb-ripple-init id="languageButton1" class="btn text-white  languageButton" data-mdb-ripple-color="dark" value="1">English</button>
                                @else
                                    <button  type="button" data-mdb-button-init data-mdb-ripple-init id="languageButton2" class="btn text-white languageButton" data-mdb-ripple-color="dark" value="2">Malayalam</button>
                                @endif
                            </li>
                            <li class="pbmit-social-li pbmit-social-facebook">
                                <a title="Facebook" href="#" target="_blank">
                                    <span><i class="pbmit-base-icon-facebook-f"></i></span>
                                </a>
                            </li>
                            <li class="pbmit-social-li pbmit-social-twitter">
                                <a title="Twitter" href="#" target="_blank">
                                    <span><i class="pbmit-base-icon-twitter-2"></i></span>
                                </a>
                            </li>
                            <li class="pbmit-social-li pbmit-social-linkedin">
                                <a title="LinkedIn" href="#" target="_blank">
                                    <span><i class="pbmit-base-icon-linkedin-in"></i></span>
                                </a>
                            </li>
                            <li class="pbmit-social-li pbmit-social-instagram">
                                <a title="Instagram" href="#" target="_blank">
                                    <span><i class="pbmit-base-icon-instagram"></i></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid headex">
            <div class="pbmit-header-content d-flex justify-content-between align-items-center">
                <div class="pbmit-logo-menuarea d-flex align-items-center">
                    <div class="site-branding">
                        <h1 class="site-title">
                            <a href="index.html">
                                <img class="pbmit-sticky-logo" src="{{asset('assets/frontend/images/log-n.png')}}" alt="Yoge">
                            </a>
                        </h1>
                    </div>
                </div>
                @include('frontend.layouts.main_menu_home')

                <!-- <div class="pbmit-right-box d-flex align-items-center">

                    <div class="pbmit-header-search-btn">
                        <a href="#" title="Search">
                            <i class="pbmit-base-icon-search-1"></i>
                        </a>
                    </div>
                     <div class="pbmit-button-box-second">
                        <a class="pbmit-btn" href="{{ route('loginview')}}">
                            <span class="pbmit-button-content-wrapper">
                                <span class="pbmit-button-icon pbmit-align-icon-right">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22.76" height="22.76" viewBox="0 0 22.76 22.76">
                                        <title>black-arrow</title>
                                        <path d="M22.34,1A14.67,14.67,0,0,1,12,5.3,14.6,14.6,0,0,1,6.08,4.06,14.68,14.68,0,0,1,1.59,1" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                        <path d="M22.34,1a14.67,14.67,0,0,0,0,20.75" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                        <path d="M22.34,1,1,22.34" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                    </svg>
                                </span>
                                <span class="pbmit-button-text">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('login') ?? 'Login' }}</span>
                            </span>
                        </a>
                    </div> 
                </div> -->
            </div>
        </div>


        <div class="w-news container-fluid ">
            <a href="{{ route('main.whatsnewmain') }}"><img src="{{asset('assets/frontend/images/new.svg')}}" alt=""></a>
            <div class="news-container">
                <ul>

                    @foreach ($whatsnews as $whatsnew)
                    @foreach ($whatsnew->announcesub as $announcesub)
                    <li>
                        <a href="{{ route('main.whatsnew',[\Crypt::encryptString($whatsnew->id)]) }}"> {{$announcesub->title}}&nbsp;&nbsp;|&nbsp;&nbsp;</a>
                    </li>
                    @endforeach
                    @endforeach

                </ul>
            </div>
        </div>
        @include('frontend.main.mainbanner')
    </header>
    <!-- Header Main Area End Here -->

    <!-- page content -->
    <div class="page-content">
        <!-- ---------------------------------------------- -->
        <section class="ihbox-section-twelve d-none">
            <div class="container-fluid p-0">
                <div class="row">
                    <div class="col-md-6 col-xl-6 pbmit-column">
                        <div class="pbmit-ihbox-style-40">
                            <div class="pbmit-ihbox-box d-flex align-items-center">
                                <div class="pbmit-ihbox-icon">
                                    <div class="pbmit-ihbox-icon-wrapper pbmit-icon-type-icon">
                                        <i class="pbmit-xcare-icon pbmit-xcare-icon-gesundheit"></i>
                                    </div>
                                </div>
                                <div class="pbmit-ihbox-contents">
                                    <h2 class="pbmit-element-title">Professional Staff</h2>
                                    <div class="pbmit-heading-desc">Medicenter offers comprehensive dental care for both adults and children.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-6 pbmit-column">
                        <div class="pbmit-ihbox-style-40">
                            <div class="pbmit-ihbox-box d-flex align-items-center">
                                <div class="pbmit-ihbox-icon">
                                    <div class="pbmit-ihbox-icon-wrapper pbmit-icon-type-icon">
                                        <i class="pbmit-xcare-icon pbmit-xcare-icon-live-chat"></i>
                                    </div>
                                </div>
                                <div class="pbmit-ihbox-contents">
                                    <h2 class="pbmit-element-title">Available 24 hours</h2>
                                    <div class="pbmit-heading-desc">Medicenter offers comprehensive dental care for both adults and children.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('frontend.main.mainministers')
      
        @include('frontend.main.mainannouncement')
       
        @include('frontend.main.mainaward')

        @include('frontend.main.maindepartment')
       
        @include('frontend.main.mainprojects')

        <!-- ----------------------------schemes---------------------------------------->
        <section class="about-section-twelve pbmit-extend-animation section-xl d-none" style="clip-path: inset(0% 3.5875% round 21.525px);">
            <div class="container">
                <div class="row align-items-center g-0">
                    <div class="col-md-12 col-xl-6 position-relative">
                        <div class="child-care-about-img">
                            <img src="{{asset('assets/frontend/images/Subtract1.png')}}" class="img-fluid" alt="">
                        </div>
                        <div class="fid-style-area">
                            <div class="pbminfotech-ele-fid-style-7">
                                <div class="pbmit-fld-contents">
                                    <div class="pbmit-fld-wrap">
                                        <h4 class="pbmit-fid-inner">
                                            <span class="pbmit-fid-before"></span>
                                            <span class="pbmit-number-rotate numinate completed">235</span>
                                            <!-- <span class="pbmit-fid"><sup>%</sup></span> -->
                                        </h4>
                                        <div class="pbmit-fid-sub">
                                            <h3 class="pbmit-fid-title">Satisfaction <br> Schemes</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="pbmit-sticky-corner pbmit-top-left-corner">
                                    <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M30 30V0C30 16 16 30 0 30H30Z"></path>
                                    </svg>
                                </div>
                                <div class="pbmit-sticky-corner  pbmit-bottom-right-corner">
                                    <svg width="30" height="30" viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M30 30V0C30 16 16 30 0 30H30Z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-xl-6">
                        <div class="about-twelve-content">
                            <div class="pbmit-heading-subheading text-white animation-style3">
                                <h4 class="pbmit-subtitle secondary-color">Schemes</h4>
                                <h2 class="{{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1' }}">Health Schemes and Services</h2>
                                <div class="pbmit-heading-desc">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum amet facilis hic totam unde aut modi asperiores optio dolorem perspiciatis non dignissimos atque enim officiis itaque necessitatibus, voluptatestatum.
                                </div>
                            </div>
                            <div class="pbmit-ihbox-style-13-new">
                                <div class="row">
                                    <article class="pbmit-miconheading-style-13 col-md-6">
                                        <div class="pbmit-ihbox-style-13">
                                            <div class="pbmit-ihbox-box">
                                                <div class="pbmit-ihbox-icon">
                                                    <div class="pbmit-ihbox-icon-wrapper">
                                                        <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                            <i class="pbmit-xcare-icon pbmit-xcare-icon-avatar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pbmit-ihbox-contents">
                                                    <h2 class="pbmit-element-title">
                                                        Health Schemes
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="pbmit-miconheading-style-13 col-md-6">
                                        <div class="pbmit-ihbox-style-13">
                                            <div class="pbmit-ihbox-box">
                                                <div class="pbmit-ihbox-icon">
                                                    <div class="pbmit-ihbox-icon-wrapper">
                                                        <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                            <i class="pbmit-xcare-icon pbmit-xcare-icon-gesundheit-1"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pbmit-ihbox-contents">
                                                    <h2 class="pbmit-element-title">
                                                        Search by Target group
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="pbmit-miconheading-style-13 col-md-6">
                                        <div class="pbmit-ihbox-style-13">
                                            <div class="pbmit-ihbox-box">
                                                <div class="pbmit-ihbox-icon">
                                                    <div class="pbmit-ihbox-icon-wrapper">
                                                        <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                            <i class="pbmit-xcare-icon pbmit-xcare-icon-pediatrics"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pbmit-ihbox-contents">
                                                    <h2 class="pbmit-element-title">
                                                        Search by Diseases
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                    <article class="pbmit-miconheading-style-13 col-md-6">
                                        <div class="pbmit-ihbox-style-13">
                                            <div class="pbmit-ihbox-box">
                                                <div class="pbmit-ihbox-icon">
                                                    <div class="pbmit-ihbox-icon-wrapper">
                                                        <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                            <i class="pbmit-xcare-icon pbmit-xcare-icon-search"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="pbmit-ihbox-contents">
                                                    <h2 class="pbmit-element-title">
                                                        Know how to Avail
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            </div>
                            <a class="pbmit-btn pbmit-btn-white" href="">
                                <span class="pbmit-button-content-wrapper">
                                    <span class="pbmit-button-icon pbmit-align-icon-right">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22.76" height="22.76" viewBox="0 0 22.76 22.76">
                                            <title>black-arrow</title>
                                            <path d="M22.34,1A14.67,14.67,0,0,1,12,5.3,14.6,14.6,0,0,1,6.08,4.06,14.68,14.68,0,0,1,1.59,1" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                            <path d="M22.34,1a14.67,14.67,0,0,0,0,20.75" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                            <path d="M22.34,1,1,22.34" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                        </svg>
                                    </span>
                                    <span class="pbmit-button-text">Search Scheme <br> Availability</span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('frontend.main.mainSolutionExchanges')
        <!-- -------------------------LMS & hero of the month---------------------------------------------- -->
        <section class="section-xl pt-2 bgw">
            <div class="container">
                <div class="row mt-4 g-0 d-flex align-items-stretch">
                    <div class="col-md-12 col-xl-6">
                        <div class="ihbox-style-4_bg pbmit-text-color-white h-100">
                            <div class="pbmit-ihbox-style-4">
                                <div class="pbmit-ihbox-headingicon animation-style2 mt-4">
                                    <h1 class="pbmit-element-title">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('learning') ?? 'Learning Management System' }} </h1>
                                    <br>
                                    <h4 class="text-white ready">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('readylearn') ?? 'Ready to start learn?' }}  <br> 
                                    {{  App\Http\Controllers\FrontendController::getSiteControlLabel('clickbutton') ?? 'Click the button !' }}
                                    </h4>
                                    <br>
                                    <div class="pbmit-ihbox-btn mt-5">
                                        <a href="https://keralahealthtraining.kerala.gov.in/" target="_blank">
                                        
                                            <span class="pbmit-button-text">
                                            {{  App\Http\Controllers\FrontendController::getSiteControlLabel('golms') ?? 'Go to LMS' }}
                                            </span>
                                            <span class="pbmit-button-icon-wrapper">
                                                <span class="pbmit-button-icon">
                                                    <i class="pbmit-base-icon-black-arrow-1"></i>
                                                </span>
                                            </span>
                                        </a>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-xl-6">
                        <div class="pbmit-ihbox-style-5_bg position-relative">
                            <img src="{{asset('assets/frontend/images/trophy1.png')}}" class="position-absolute trophy" alt="">
                            <div class="pbmit-ihbox-style-5 naam">
                                <h1 class="pbmit-element-title text-light"> {{  App\Http\Controllers\FrontendController::getSiteControlLabel('heromonth') ?? 'Hero of the Month' }}</h1>
                                <div class="pbmit-ihbox-box my-5 d-flex align-items-center">
                                    <div class="mr50 pbmit-ihbox-icon ">
                                        <div class="pbmit-ihbox-icon-wrapper">
                                            <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                <img src="{{asset('/assets/backend/uploads/HeroOfMonth/'.$HerooftheMonth->file)}} " class="hero" alt="">
                                            </div>
                                            <img src="{{asset('assets/frontend/images/28844429_7462842-ai.png')}} " class="hero-f" alt="">
                                        </div>
                                    </div>
                                    <div class="pbmit-ihbox-contents text-light naam">
                                        <h5 class="text-light">{{$HerooftheMonth->heromonthsub[0]->title}}</h5>
                                        <p>{!! $HerooftheMonth->heromonthsub[0]->description !!}.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('frontend.main.mainwellnesstips')
        <!-- ----------------SURVEY----------------------------------- -->
        <section class="section-xl testimonial-eleven ">
            <div class="container">
                <div class="position-relative">
                    <div class="row">
                        <div class="col-md-12 col-xl-5">
                            <div class="pbmit-testimonialbox-left">
                                <div class="pbmit-heading-subheading animation-style2">
                                    <h4 class="pbmit-subtitle">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('survey') ?? 'Survey' }}</h4>
                                    <h2 class="{{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1' }} text-light">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('dosurvey') ?? "Let's do some survey" }}</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-xl-7">
                            <div class="swiper-slider" data-arrows-class="" data-autoplay="fasle" data-loop="false" data-dots="false" data-arrows="true" data-columns="2" data-margin="30" data-effect="slide">
                                <div class="swiper-wrapper">
                                    <!-- Slide1 -->
                                    <article class="pbmit-testimonial-style-4 swiper-slide">
                                        <div class="pbminfotech-post-item">
                                            <img src="{{asset('assets/frontend/images/new.png')}}" class="position-absolute newx" alt="">
                                            <div class="pbmit-box-content-wrap">
                                                <div class="pbminfotech-box-desc">
                                                    <img src="{{asset('assets/frontend/images/sr2.png')}}" class="w-100 img-fluid" alt="">
                                                </div>
                                                <div class="pbminfotech-box-author mb-3">
                                                    <div class="pbmit-auther-content">
                                                        <h3 class="pbminfotech-box-title">Survey about modern health system</h3>
                                                        <div class="pbminfotech-testimonial-detail">Last Date : 20.05.2024 5pm</div>
                                                    </div>
                                                </div>
                                                <div class="opinion">
                                                    <a href="#">Make your opinion </a>
                                                </div>
                                            </div>

                                        </div>
                                    </article>
                                    <!-- Slide2 -->
                                    <article class="pbmit-testimonial-style-4 swiper-slide">
                                        <div class="pbminfotech-post-item">
                                            <!-- <img src="{{asset('assets/frontend/images/images/new.png')}}" class="position-absolute newx" alt=""> -->
                                            <div class="pbmit-box-content-wrap">
                                                <div class="pbminfotech-box-desc">
                                                    <img src="{{asset('assets/frontend/images/s1.png')}}" class="w-100 img-fluid" alt="">
                                                </div>
                                                <div class="pbminfotech-box-author mb-3">
                                                    <div class="pbmit-auther-content">
                                                        <h3 class="pbminfotech-box-title">Survey about modern health system</h3>
                                                        <div class="pbminfotech-testimonial-detail">Last Date : 20.05.2024 5pm</div>
                                                    </div>
                                                </div>
                                                <div class="opinion">
                                                    <a href="#">Make your opinion </a>
                                                </div>
                                            </div>

                                        </div>
                                    </article>
                                    <!-- Slide3 -->
                                    <article class="pbmit-testimonial-style-4 swiper-slide">
                                        <div class="pbminfotech-post-item">
                                            <!-- <img src="{{asset('assets/frontend/images/images/new.png')}}" class="position-absolute newx" alt=""> -->
                                            <div class="pbmit-box-content-wrap">
                                                <div class="pbminfotech-box-desc">
                                                    <img src="{{asset('assets/frontend/images/sr2.png')}}" class="w-100 img-fluid" alt="">
                                                </div>
                                                <div class="pbminfotech-box-author mb-3">
                                                    <div class="pbmit-auther-content">
                                                        <h3 class="pbminfotech-box-title">Survey about modern health system</h3>
                                                        <div class="pbminfotech-testimonial-detail">Last Date : 20.05.2024 5pm</div>
                                                    </div>
                                                </div>
                                                <div class="opinion">
                                                    <a href="#">Make your opinion </a>
                                                </div>
                                            </div>

                                        </div>
                                    </article>
                                    <!-- Slide4 -->
                                    <article class="pbmit-testimonial-style-4 swiper-slide">
                                        <div class="pbminfotech-post-item">
                                            <!-- <img src="{{asset('assets/frontend/images/images/new.png')}}" class="position-absolute newx" alt=""> -->
                                            <div class="pbmit-box-content-wrap">
                                                <div class="pbminfotech-box-desc">
                                                    <img src="{{asset('assets/frontend/images/sr2.png')}}" class="w-100 img-fluid" alt="">
                                                </div>
                                                <div class="pbminfotech-box-author mb-3">
                                                    <div class="pbmit-auther-content">
                                                        <h3 class="pbminfotech-box-title">Survey about modern health system</h3>
                                                        <div class="pbminfotech-testimonial-detail">Last Date : 20.05.2024 5pm</div>
                                                    </div>
                                                </div>
                                                <div class="opinion">
                                                    <a href="#">Make your opinion </a>
                                                </div>
                                            </div>

                                        </div>
                                    </article>
                                    <!-- Slide5 -->
                                    <article class="pbmit-testimonial-style-4 swiper-slide">
                                        <div class="pbminfotech-post-item">
                                            <img src="{{asset('assets/frontend/images/new.png')}}" class="position-absolute newx" alt="">
                                            <div class="pbmit-box-content-wrap">
                                                <div class="pbminfotech-box-desc">
                                                    <img src="{{asset('assets/frontend/images/sr2.png')}}" class="w-100 img-fluid" alt="">
                                                </div>
                                                <div class="pbminfotech-box-author mb-3">
                                                    <div class="pbmit-auther-content">
                                                        <h3 class="pbminfotech-box-title">Survey about modern health system</h3>
                                                        <div class="pbminfotech-testimonial-detail">Last Date : 20.05.2024 5pm</div>
                                                    </div>
                                                </div>
                                                <div class="opinion">
                                                    <a href="#">Make your opinion </a>
                                                </div>
                                            </div>

                                        </div>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @include('frontend.main.mainHealthalert')

        <!-- -----------------grivance----------------------------------- -->
        <section class="appointment-section-five section-md">
            <div class="container">
                <div class="appointment-five-bg">
                    <h2 class="{{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1' }}">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('grievance') ?? 'Grievance Section' }}</h2>
                    <form class="form-style-2">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" placeholder="Your Name *" name="name">
                                <input type="email" class="form-control" placeholder="Your Email *" name="email">
                            </div>
                            <div class="col-md-3">
                                <input type="tel" class="form-control" placeholder="Your Phone *" name="phone">
                                <select class="form-select form-control" aria-label="Default select example">
                                    <option value="Choose Doctor">Choose Type</option>
                                    <option value="Jordan Peele">Jordan Peele</option>
                                    <option value="Norton Berry">Norton Berry</option>
                                    <option value="Clare Smyth">Clare Smyth</option>
                                    <option value="Jamie Oliver">Jamie Oliver</option>
                                    <option value="Carla Hall">Carla Hall</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <textarea name="message" cols="40" rows="10" class="form-control" placeholder="Type Appointment Note...."></textarea>
                            </div>
                            <div class="col-md-12 col-xl-2">
                                <a class="pbmit-btn" href="make-appointments-01.html">
                                    <span class="pbmit-button-content-wrapper">
                                        <span class="pbmit-button-icon pbmit-align-icon-right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22.76" height="22.76" viewBox="0 0 22.76 22.76">
                                                <title>black-arrow</title>
                                                <path d="M22.34,1A14.67,14.67,0,0,1,12,5.3,14.6,14.6,0,0,1,6.08,4.06,14.68,14.68,0,0,1,1.59,1" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                                <path d="M22.34,1a14.67,14.67,0,0,0,0,20.75" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                                <path d="M22.34,1,1,22.34" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                            </svg>
                                        </span>
                                        <span class="pbmit-button-text">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('submit') ?? 'Submit' }}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <!-- page content End -->

    <!-------------------------- footer ----------------------------->
    <div class="footer-top-section pbmit-bg-color-blackish" style="background-color: #031b4e;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 pbmit-col_1">
                    <ul class="pbmit-icon-list-items pbmit-inline-items">
                        <li class="pbmit-icon-list-item pbmit-inline-item">
                            <a href="#">
                                <span class="pbmit-icon-list-text">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('healthanalytics') ?? 'Health Analytics' }}</span>
                            </a>
                        </li>
                        <li class="pbmit-icon-list-item pbmit-inline-item">
                            <a href="#">
                                <span class="pbmit-icon-list-text">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('awards') ?? 'Awards' }}</span>
                            </a>
                        </li>
                        <li class="pbmit-icon-list-item pbmit-inline-item">
                            <a href="#">
                                <span class="pbmit-icon-list-text">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('healthpolicies') ?? 'Health policies' }}</span>
                            </a>
                        </li>
                        <li class="pbmit-icon-list-item pbmit-inline-item">
                            <a href="#">
                                <span class="pbmit-icon-list-text">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('callsupport') ?? 'Call Support' }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-2 pbmit-col_2">
                    <div class="pbmit-ihbox-style-13">
                        <div class="pbmit-ihbox-box">
                            <div class="pbmit-ihbox-icon">
                                <div class="pbmit-ihbox-icon-wrapper">
                                    <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                        <i class="pbmit-xcare-icon pbmit-xcare-icon-phone-call"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pbmit-ihbox-contents">
                                <h2 class="pbmit-element-title">0471 25452</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 pbmit-col_3">
                    <div class="pbmit-ihbox-style-13">
                        <div class="pbmit-ihbox-box">
                            <div class="pbmit-ihbox-icon">
                                <div class="pbmit-ihbox-icon-wrapper">
                                    <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                        <i class="pbmit-xcare-icon pbmit-xcare-icon-email"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="pbmit-ihbox-contents">
                                <h2 class="pbmit-element-title">info@demo.com</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('frontend.main.mainfooter')

</div>
<!-- page wrapper End -->

<!-- Search Box Start Here -->
<div class="pbmit-search-overlay">
    <div class="pbmit-icon-close">
        <svg class="qodef-svg--close qodef-m" xmlns="http://www.w3.org/2000/svg" width="28.163" height="28.163" viewBox="0 0 26.163 26.163">
            <rect width="36" height="1" transform="translate(0.707) rotate(45)"></rect>
            <rect width="36" height="1" transform="translate(0 25.456) rotate(-45)"></rect>
        </svg>
    </div>
    <div class="pbmit-search-outer">
        <form class="pbmit-site-searchform">
            <input type="search" class="form-control field searchform-s" name="s" placeholder="Search …">
            <button type="submit"></button>
        </form>
    </div>
</div>
<!-- Search Box End Here -->

<!-- Scroll To Top -->
<div class="pbmit-progress-wrap">
    <svg class="pbmit-progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"></path>
    </svg>
</div>
<!-- Scroll To Top End -->
<script>
  $('.languageButton').on('click', function() {
    // Toggle text between English and Malayalam
   // Get the current text of the button and trim any whitespace
   const currentText = $(this).text().trim();
   var newValue = $(this).val();

//    alert(newValue);
    // Determine the new text based on the current text
    // const newText = currentText === 'English' ? 'Malayalam' : 'English';
    
    // // Determine the new value based on the current language
    // const newValue = currentText === 'English' ? '2' : '1'; // 1 for English, 2 for Malayalam
    
    // // For logging or further processing, define the language variable
    // const language = newText.toLowerCase(); // This will give 'malayalam' or 'english'
    // const LangId = $(this).val();
    // // Update the button text with the new language
    // $(this).text(newText);
// alert(newValue);
    if (newValue == 1) {
            $.ajax({
                url: "/setbilingualval",
                dataType: "json",
                success: function (data) {
                    window.location.reload();

                }
            })
        } else {
            $.ajax({
                url: "/setbilingualvalmal",
                dataType: "json",
                success: function (data) {
                    window.location.reload();
                }
            })
        }

});
</script>

@endsection