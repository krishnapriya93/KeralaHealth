@extends('frontend.layouts.main_header')

@section('content')

<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    <!-- Header Main Area start Here -->
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->
    <!-- Header Main Area End Here -->
    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper article_bg">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">Announcements</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Title Bar End-->
    <!-- page content -->
    <div class="page-content">

        <section class="site_content blog-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 blog-right-col">
                        <article class="main-article">
                            <div class="pbmit-ihbox-style-21">
                                <div class="pbmit-ihbox-headingicon">
                                    <div class="pbmit-ihbox-contents w-100">

                                        <div class="news1">
                                            <ul>
                                                <li class="img-ico"><img src="{{asset('assets/frontend/images/mic.png')}}" alt=""></li>
                                                <li><p>{{ $announcementitem->announcesub[0]->title }}
                                                        <br>{{ \Carbon\Carbon::parse($announcementitem->s_date)->format('d F Y') }}
                                                        </span>
                                                    </p>
                                                    <p>{!! $announcementitem->announcesub[0]->description !!}</p>
                                                </li>
                                            </ul>
                                        </div>
                                        <hr>
                                        
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-12 col-lg-3 blog-left-col">
                        <aside class="sidebar">
                            <aside class="widget widget-recent-post">
                                <h2 class="widget-title">What’s New</h2>
                                <ul class="recent-post-list">
                                    <li class="recent-post-list-li">
                                        <div class="pbmit-rpw-content">
                                            <span class="pbmit-rpw-date">
                                                <a href="blog-details.html">August 29, 2023</a>
                                            </span>
                                            <span class="pbmit-rpw-title">
                                                <a href="blog-details.html">What’s the reason so many older adults aren’t active?</a>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="recent-post-list-li">
                                        <div class="pbmit-rpw-content">
                                            <span class="pbmit-rpw-date">
                                                <a href="blog-details.html">August 29, 2023</a>
                                            </span>
                                            <span class="pbmit-rpw-title">
                                                <a href="blog-details.html">The Most important Ventilator Equipment available</a>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="recent-post-list-li">
                                        <div class="pbmit-rpw-content">
                                            <span class="pbmit-rpw-date">
                                                <a href="blog-details.html">August 29, 2023</a>
                                            </span>
                                            <span class="pbmit-rpw-title">
                                                <a href="blog-details.html">Blood Cancers: Early Signs, Symptoms, Institute</a>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="recent-post-list-li">
                                        <div class="pbmit-rpw-content">
                                            <span class="pbmit-rpw-date">
                                                <a href="blog-details.html">August 29, 2023</a>
                                            </span>
                                            <span class="pbmit-rpw-title">
                                                <a href="blog-details.html">What’s the reason so many older adults aren’t active?</a>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="recent-post-list-li">
                                        <div class="pbmit-rpw-content">
                                            <span class="pbmit-rpw-date">
                                                <a href="blog-details.html">August 29, 2023</a>
                                            </span>
                                            <span class="pbmit-rpw-title">
                                                <a href="blog-details.html">The Most important Ventilator Equipment available</a>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="recent-post-list-li">
                                        <div class="pbmit-rpw-content">
                                            <span class="pbmit-rpw-date">
                                                <a href="blog-details.html">August 29, 2023</a>
                                            </span>
                                            <span class="pbmit-rpw-title">
                                                <a href="blog-details.html">What’s the reason so many older adults aren’t active?</a>
                                            </span>
                                        </div>
                                    </li>
                                    <li class="recent-post-list-li">
                                        <div class="pbmit-rpw-content">
                                            <span class="pbmit-rpw-date">
                                                <a href="blog-details.html">August 29, 2023</a>
                                            </span>
                                            <span class="pbmit-rpw-title">
                                                <a href="blog-details.html">The Most important Ventilator Equipment available</a>
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                            </aside>
                            <aside class="widget pbmit-service-ad">
                                <div class="textwidget">
                                    <div class="pbmit-service-ads">
                                        <h5 class="pbmit-ads-subheding">Our Newsletter</h5>
                                        <h4 class="pbmit-ads-subtitle">Ready to start learn ?</h4>
                                        <h3 class="pbmit-ads-title">Sign up now!</h3>
                                        <div class="pbmit-ads-desc">
                                            <i class="pbmit-base-icon-phone-call-1"></i>+(123) 1234-567-8901
                                        </div>
                                        <a class="pbmit-btn" href="#">
                                            <span class="pbmit-button-content-wrapper">
                                                <span class="pbmit-button-icon pbmit-align-icon-right">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22.76" height="22.76" viewBox="0 0 22.76 22.76">
                                                        <title>black-arrow</title>
                                                        <path d="M22.34,1A14.67,14.67,0,0,1,12,5.3,14.6,14.6,0,0,1,6.08,4.06,14.68,14.68,0,0,1,1.59,1" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                                        <path d="M22.34,1a14.67,14.67,0,0,0,0,20.75" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                                        <path d="M22.34,1,1,22.34" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                                    </svg>
                                                </span>
                                                <span class="pbmit-button-text">Register now</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </aside>
                            <aside class="widget widget-tag-cloud">
                                <h3 class="widget-title">Tag Cloud</h3>
                                <div class="tagcloud">
                                    <a href="blog-classic.html" class="tag-cloud-link">Cardiac</a>
                                    <a href="blog-classic.html" class="tag-cloud-link">Care</a>
                                    <a href="blog-classic.html" class="tag-cloud-link">Doctors</a>
                                    <a href="blog-classic.html" class="tag-cloud-link">Heath</a>
                                    <a href="blog-classic.html" class="tag-cloud-link">Medical</a>
                                    <a href="blog-classic.html" class="tag-cloud-link">Surgery</a>
                                </div>
                            </aside>
                        </aside>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- page content End -->

    <!-------------------------- footer ----------------------------->

    @include('frontend.layouts.main_footer')

</div>
<!-- page wrapper End -->


@include('frontend.layouts.search_scroll')

<!-- JS-->


@include('frontend.layouts.include_scripts')

@endsection