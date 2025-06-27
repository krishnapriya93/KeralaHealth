@extends('frontend.layouts.main_header')

@section('content')

<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    <!-- Header Main Area -->
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->
    <!-- Header Main Area End Here -->
    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title"> What’s New </h1>
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
                            <div class="post blog-classic">
                                <div class="pbmit-heading animation-style1">

                                    <h3 class="mb-3 {{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1' }}">
                                        @foreach($whatsnewitems->announcesub as $announcesub) 
                                        {{ $announcesub->title }}
                                        @endforeach
                                    </h3>
                                </div>
                                <div class="pbmit-blog-classic-inner">
                                    <div class="pbmit-blog-meta pbmit-blog-meta-top">
                                        <span class="pbmit-meta pbmit-meta-date">
                                            <i class="pbmit-base-icon-calendar-3"></i>&nbsp;{{ \Carbon\Carbon::parse($whatsnewitems->date)->format('F d, Y') }}
                                        </span>
                                        <span class="pbmit-meta pbmit-meta-author">
                                            <i class="pbmit-base-icon-user-3"></i>by admin
                                        </span>
                                        <span class="pbmit-meta pbmit-meta-comments pbmit-comment-bigger-than-zero">
                                            <i class="pbmit-base-icon-chat-3"></i>3 Comments
                                        </span>
                                    </div>
                                    <div class="pbmit-entry-content">
                                        <p class="pbmit-firstletter">{!! $whatsnewitems->announcesub[0]->description !!}                                        </p>
                                        <p>If you run an internet search for medical blogs, you’ll come across hundreds of results. And figuring out which sources are reputable can take a lot of time. To help ease the process, we compiled this list of 55 of our favorite medical blogs everyone in the field can learn from Whether you’re, you’ve been a physician for years, or you simply want to know how make considering medical school well-informed decisions about your own health, there’s something on this list for everyone. Keep this list of medical blogs handy and the answers to your medical away.</p>
                                        <div class="project-single-img_box">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="pbmit-animation-style1">
                                                        <img src="images/child-care-about.jpg" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="pbmit-animation-style1">
                                                        <img src="images/child-care-about.jpg" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>

                            <!-- <nav class="navigation post-navigation" aria-label="Posts">
                                <div class="nav-links">
                                    <div class="nav-previous">
                                        <a href="blog-details.html" rel="prev">
                                            <span class="pbmit-post-nav-icon">
                                                <i class="pbmit-base-icon-left-arrow-1"></i>
                                                <span class="pbmit-post-nav-head">Previous Post</span>
                                            </span>
                                            <span class="pbmit-post-nav-wrapper">
                                                <span class="pbmit-post-nav nav-title">Blood Cancers: Early Signs, Symptoms, Institute</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="nav-next">
                                        <a href="#" rel="next">
                                            <span class="pbmit-post-nav-icon">
                                                <span class="pbmit-post-nav-head">Next Post</span>
                                                <i class="pbmit-base-icon-next"></i>
                                            </span>
                                            <span class="pbmit-post-nav-wrapper">
                                                <span class="pbmit-post-nav nav-title">What’s the reason so many older adults aren’t active?</span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </nav> -->
                        </article>
                    </div>
                    <div class="col-md-12 col-lg-3 blog-left-col">
                        
                        <aside class="sidebar">
                            <aside class="widget widget-recent-post">
                                <h2 class="widget-title">Related Whats new</h2>
                                <ul class="recent-post-list">
                                    @foreach ($whatsnewallitems as $whatsnewallitem)
                                        @foreach ($whatsnewallitem->announcesub as $announcesub)
                                        <li class="recent-post-list-li">
                                            <div class="pbmit-rpw-content">
                                                <span class="pbmit-rpw-date">
                                                    <a href="blog-details.html">{{ \Carbon\Carbon::parse($whatsnewallitem->s_date)->format('F d, Y') }}
                                                    </a>
                                                </span>
                                                <span class="pbmit-rpw-title">
                                                    <a href="blog-details.html">{{ $announcesub->title }} </a>
                                                </span>
                                            </div>
                                        </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </aside>
                            <!-- <aside class="widget pbmit-service-ad">
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
                            </aside> -->
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

<!-- JS
		============================================ -->
<!-- jQuery JS -->
@include('frontend.layouts.include_scripts')

@endsection