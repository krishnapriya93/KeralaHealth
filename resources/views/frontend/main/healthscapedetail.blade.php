@extends('frontend.layouts.main_header')

@section('content')


<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->
    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper healthescap_bg">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('healthscape') ?? 'Healthscape' }}</h1>
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
                        <div class="col-lg- pr-15 blog-right-col">
                            <div class="pbmit-team-single-info">
                                <div class="row">
                                    <div class="col-sm-12 col-md-3">
                                        <div class="pbmit-sticky-cl">
                                            <div class="pbmit-team-left-inner">
                                                <div class="pbmit-featured-wrapper">
                                                @foreach($mainhealthscapes->articleval_sub as $articleval_sub)
                                                @if(!empty($articleval_sub->file))
                                                    <img src="{{ asset('/assets/backend/uploads/articles/' . $articleval_sub->file) }}" class="img-fluid w-100" alt="" style="border-radius: 30px 30px 0 0;">
                                                @endif
                                                @endforeach
                                         
                                                </div>
                                                <!-- <div class="pbmit-team-detail">
                                                    <div class="pbmit-team-detail-inner">
                                                        <div class="pbmit-team-summary">
                                                            <h2 class="pbmit-team-title text-center"> @foreach($mainhealthscapes->articleval_sub as $articleval_sub)
                                                                    {{$articleval_sub->title ?? ''}}
                                                            @endforeach</h2>
                                                        </div>
                                                        <br>
                                                          <a href="https://arogyakeralam.gov.in/" class="w-link"> https://arogybnhmdgyjtyjakeralam.gov.in/</a>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-9 bg-white br-30">
                                        <article class="main-article px-2 py-3">
                                            <div class="post blog-classic">    
                                                <div class="pbmit-heading animation-style1">
                                                    <h3 class="mb-2 {{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1' }}" style="font-weight: 500;font-size: 30px;"> @foreach($mainhealthscapes->articleval_sub as $articleval_sub)
                                                        {{$articleval_sub->title ?? ''}}
                                                @endforeach</h3>
                                                </div>
                                                <div class="pbmit-blog-classic-inner">
                                                  
                                                    <div class="tabx mt-3">
                                                      
                                                        <div class="tab-content mt-3" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="home" role="tabpanel">
                                                                <div class="pbmit-entry-content">
                                                                    <div class="square">
                                                                        <img src="images/ui.png" class="img-fluid w-100" alt="">
                                                            
                                                                      
                                                                        <p class="pbmit-firstletter" style="text-align: justify;">
                                                                        @foreach($mainhealthscapes->articleval_sub as $articleval_sub)
                                                                        {!! strip_tags($articleval_sub->content, '<font><p>') !!}
                                                                        @endforeach
                                                                            <!-- Medical Futurist is one of the best online resources for learning about technology in the medical sphere. There’s a real sense skepticism uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde in each post from medical doctor and geneticist Mesko, a blog covering new technologies targeted toward numerous specialties. -->
                                                                        </p>
                                                                        <!-- <p>If you run an internet search for medical blogs, you’ll come across hundreds of results. And figuring out which sources are reputable can take a lot of time. To help ease the process, we compiled this list of 55 of our favorite medical blogs everyone in the field can learn from Whether you’re, you’ve been a physician for years, or you simply want to know how make considering medical school well-informed decisions about your own health, there’s something on this list for everyone. Keep this list of medical blogs handy and the answers to your medical away.</p>                                                      -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="practice" role="tabpanel">
                                                                <div class="pbmit-entry-content">
                                                                    <div class="square">
                                                                        
                                                                        <p class="pbmit-firstletter" style="text-align: justify;">
                                                                            
                                                                            Medical Futurist is one of the best online resources for learning about technology in the medical sphere. There’s a real sense skepticism uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde in each post from medical doctor and geneticist Mesko, a blog covering new technologies targeted toward numerous specialties.
                                                                        </p>
                                                                        <!-- <p>If you run an internet search for medical blogs, you’ll come across hundreds of results. And figuring out which sources are reputable can take a lot of time. To help ease the process, we compiled this list of 55 of our favorite medical blogs everyone in the field can learn from Whether you’re, you’ve been a physician for years, or you simply want to know how make considering medical school well-informed decisions about your own health, there’s something on this list for everyone. Keep this list of medical blogs handy and the answers to your medical away.</p>                                                      -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="tab-pane fade" id="innovation" role="tabpanel">333333333333</div>
                                                            <div class="tab-pane fade" id="infra" role="tabpanel">444444444</div>
                                                            <div class="tab-pane fade" id="achive" role="tabpanel">555555555555</div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>   
                                            </div> 
                                            
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                            
                        </style>
                      
                        <div class="col-md-12 col-lg-3 blog-left-col">
                         <aside class="sidebar">
                                <aside class="widget widget-recent-post">
                                    <h2 class="widget-title">Recent News</h2>
                                        <ul class="recent-post-list">
                                            <li class="recent-post-list-li"> 
                                                <a class="recent-post-thum" href="blog-details.html">
                                                    <img src="images/related.png" class="img-fluid" alt="">
                                                </a>
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
                                                <a class="recent-post-thum" href="blog-details.html">
                                                    <img src="images/related.png" class="img-fluid" alt="">
                                                </a>
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
                                                <a class="recent-post-thum" href="blog-details.html">
                                                    <img src="images/related.png" class="img-fluid" alt="">
                                                </a>
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
                                                <a class="recent-post-thum" href="blog-details.html">
                                                    <img src="images/related.png" class="img-fluid" alt="">
                                                </a>
                                                <div class="pbmit-rpw-content">
                                                    <span class="pbmit-rpw-date">
                                                        <a href="blog-details.html">August 29, 2023</a>
                                                    </span>
                                                    <span class="pbmit-rpw-title">
                                                        <a href="blog-details.html">What’s the reason so many older adults aren’t active?</a>
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

    </div>
    <!-- page content End -->

    <!-------------------------- footer ----------------------------->
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