@extends('frontend.layouts.main_header')

@section('content')

<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->
    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title"> {{$awards->awardsub[0]->title}} </h1>
                        </div>
                    </div>

                    <!-- <div class="pbmit-breadcrumb">
                              <div class="pbmit-breadcrumb-inner">
                                  <span>
                                      <a title="" href="#" class="home"><span>Xcare</span></a>
                                  </span>
                                  <span class="sep">
                                      <i class="pbmit-base-icon-angle-double-right"></i>
                                  </span>
                                  <span><span class="post-root post post-post current-item">Dentist</span></span>
                                  <span class="sep">
                                      <i class="pbmit-base-icon-angle-double-right"></i>
                                  </span>
                                  <span><span class="post-root post post-post current-item"> The Most important Ventilator Equipment available</span></span>
                              </div>
                          </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Title Bar End-->
    <!-- page content -->
    <div class="page-content">

        <!-- //////////////////////// -->
        <section class="site_content blog-details">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 blog-right-col">
                                    <article class="main-article" style="position: relative;">
                                        <img src="{{ asset('/assets/frontend/images/trofi.png') }}" alt="" class="trofi">
                                        <div class="post blog-classic">    
                                            <div class="pbmit-heading animation-style1 w-90">
                                                <h3 class="pbmit-title mb-2">{{$awards->awardsub[0]->title}} </h3>
                                                <div class="d-flex align-items-center">
                                                    <img src="{{ asset('/assets/frontend/images/depart.gif') }}" width="35" alt=""><span class="depart ms-1">National Health Mission</span>
                                                </div>
                                            </div>
                                            <div class="pbmit-blog-classic-inner">
                                                <div class="pbmit-blog-meta pbmit-blog-meta-top">
                                                </div>
                                                <div class="pbmit-entry-content">
                                                    <p> {!! strip_tags($awards->awardsub[0]->description, '<font><p>') !!}</p>
                                                    <!-- <p>If you run an internet search foa lot of time. To helake considering medical school well-informed decisions about your own health, there’s something on this list for everyone. Keep this list of medical blogs handy and the answers to your medical away.</p> -->
                                                    <div class="project-single-img_box zoom-gallery">
                                                        <div class="row">                                                           
                                                       @foreach($awards->awarditem as $awarditem)
                                                      
                                                            @if(!empty($awarditem->image))
                                                            <div class="col-md-4 mb-3">
                                                                <div class="pbmit-animation-style1">
                                                                    <a href="{{ asset('/assets/backend/uploads/Awarditem/' . $awarditem->image) }}" class="zoomi" data-source=" " title="">
                                                                        <img src="{{ asset('/assets/backend/uploads/Awarditem/' . $awarditem->image) }}" class="w-100" >
                                                                        <i class="pbmit-base-icon-search-1  "></i>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        @endforeach    
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>   
                                        </div>
                                    </article>
                        </div>
                        <div class="col-md-12 col-lg-3 blog-left-col">
                            <aside class="sidebar">
                                <aside class="widget widget-recent-post">
                                    <h2 class="widget-title">Related Awards</h2>
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
                                                        <a href="blog-details.html">Blood Cancers: Early Signs, Symptoms, Institute</a>
                                                    </span>
                                                </div> 
                                            </li>
                                        </ul>
                                </aside> 
                            </aside>
                        </div>
                    </div>
                </div>
            </section>
         <!-- /////////////////////// -->

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
                                <span class="pbmit-icon-list-text">Health Analytics</span>
                            </a>
                        </li>
                        <li class="pbmit-icon-list-item pbmit-inline-item">
                            <a href="#">
                                <span class="pbmit-icon-list-text">Awards</span>
                            </a>
                        </li>
                        <li class="pbmit-icon-list-item pbmit-inline-item">
                            <a href="#">
                                <span class="pbmit-icon-list-text">Health policies</span>
                            </a>
                        </li>
                        <li class="pbmit-icon-list-item pbmit-inline-item">
                            <a href="#">
                                <span class="pbmit-icon-list-text">Call Support</span>
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
    <footer class="site-footer">
        <div class="pbmit-footer-widget-area">
            <div class="container">
                <div class="row">
                    <div class="pbmit-footer-widget-col-1 col-md-6 col-lg-3">
                        <aside class="widget widget_text">
                            <div class="textwidget">
                                <div class="pbmit-footer-logo">
                                    <img src="images/log-n.png" alt="">
                                </div>
                                <div class="pbmit-footer-text">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, aperiam quis rem quidem quo ex consequatur.
                                </div>
                                <ul class="pbmit-social-links">
                                    <li class="pbmit-social-li pbmit-social-facebook">
                                        <a title="Facebook" href="https://www.facebook.com/" target="_blank" rel="noopener">
                                            <span><i class="pbmit-base-icon-facebook-f"></i></span>
                                        </a>
                                    </li>
                                    <li class="pbmit-social-li pbmit-social-twitter">
                                        <a title="Twitter" href="https://www.twitter.com/" target="_blank" rel="noopener">
                                            <span><i class="pbmit-base-icon-twitter-2"></i></span>
                                        </a>
                                    </li>
                                    <li class="pbmit-social-li pbmit-social-linkedin">
                                        <a title="LinkedIn" href="https://www.linkedin.com/" target="_blank" rel="noopener">
                                            <span><i class="pbmit-base-icon-linkedin-in"></i></span>
                                        </a>
                                    </li>
                                    <li class="pbmit-social-li pbmit-social-instagram">
                                        <a title="Instagram" href="https://www.instagram.com/" target="_blank" rel="noopener">
                                            <span><i class="pbmit-base-icon-instagram"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </aside>
                    </div>
                    <div class="pbmit-footer-widget-col-2 col-md-6 col-lg-3">
                        <div class="widget">
                            <h2 class="widget-title">Useful Link</h2>
                            <div class="textwidget">
                                <ul>
                                    <li><a href="#">FAQ's</a></li>
                                    <li><a href="#">User Guides</a></li>
                                    <li><a href="#">Schemes</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pbmit-footer-widget-col-3 col-md-6 col-lg-3">
                        <div class="widget">
                            <h2 class="widget-title">Important Links</h2>
                            <div class="pbmit-timelist-wrapper">
                                <ul class="pbmit-timelist-list">
                                    <li><a href="#" class="pbmit-timelist-li-title">Services 1</a></li>
                                    <li><a href="#" class="pbmit-timelist-li-title">Services 1</a></li>
                                    <li><a href="#" class="pbmit-timelist-li-title">Services 1</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="pbmit-footer-widget-col-4 col-md-6 col-lg-3">
                        <aside class="widget">
                            <h2 class="widget-title">Contact</h2>
                            <div class="pbmit-contact-widget-line pbmit-contact-widget-address">
                                Phone: &nbsp;<b>0471 025461</b>
                            </div>
                            <div class="pbmit-contact-widget-line pbmit-contact-widget-address">
                                Address:&nbsp; Sample heath address <br> 2546 kerala
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </div>
        <div class="pbmit-footer-text-area">
            <div class="container">
                <div class="pbmit-footer-text-inner">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="pbmit-footer-copyright-text-area"> Copyright © 2024 <a href="#" style="  color: var(--pbmit-global-color);"><b>C-Dit</b></a> </div>
                        </div>
                        <div class="col-md-6">
                            <ul class="pbmit-footer-menu">
                                <li class="menu-item">
                                    <a href="#">Terms and conditions</a>
                                </li>
                                <li class="menu-item">
                                    <a href="#">Privacy policy</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer End -->

</div>

<!-------------------------- footer ----------------------------->

@include('frontend.layouts.main_footer')

</div>
<!-- page wrapper End -->


@include('frontend.layouts.search_scroll')

<!-- JS-->


@include('frontend.layouts.include_scripts')

@endsection