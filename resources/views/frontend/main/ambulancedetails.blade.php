@extends('frontend.layouts.main_header')

@section('content')
<style>
    .custom-list ul {
        list-style-type: none; 
        padding: 0;
    }
    .custom-list li {
        position: relative;
        padding-left: 25px; /* Adjust based on icon size */
        margin-bottom: 10px;
    }
    .custom-list li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 3px;
        /* Render the icon using Blade Icons */
        display: inline-block;
        width: 15px; /* Adjust based on icon size */
        height: 15px; /* Adjust based on icon size */
        background-size: contain;
        background-repeat: no-repeat;
        background-image: url('{{ asset('/assets/frontend/images/p1.png') }}');
    }
    li::marker {
            content: none;
        }
</style>

<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->
    <!-- Title Bar -->
   
    <div class="pbmit-title-bar-wrapper">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">{{ $ambulancedetails->articleval_sub[0]->title }}</h1>
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
                        <div class="col-lg-12 pr-15 blog-right-col">
                            <div class="pbmit-team-single-info">
                                <div class="row">
                                   
                                    <div class="col-sm-12 col-md-12 bg-white br-30">
                                        <article class="main-article px-2 py-3">
                                            <div class="post blog-classic">    
                                                <div class="pbmit-heading animation-style1">
                                                    <h3 class="mb-2 {{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1' }}" style="font-weight: 500;font-size: 30px;"> @foreach($ambulancedetails->articleval_sub as $articleval_sub)
                                                        {{$articleval_sub->title ?? ''}}
                                                @endforeach</h3>
                                                </div>
                                                <div class="pbmit-blog-classic-inner">
                                                  
                                                    <div class="tabx mt-3">
                                                      
                                                        <div class="tab-content mt-3" id="myTabContent">
                                                            <div class="tab-pane fade show active" id="home" role="tabpanel">
                                                                <div class="pbmit-entry-content">
                                                                    <div class="square">
                                                                        <img src="{{ asset('/assets/frontend/images/ui.png') }}" class="img-fluid w-100" alt="">
                                                            
                                                                      
                                                                        <div class="pbmit-firstletter custom-list" style="text-align: justify;">
                                                                        @foreach($ambulancedetails->articleval_sub as $articleval_sub)
                                                                        {!! strip_tags($articleval_sub->content, '<font><p><a><ul><li><table><tbody><thead><tr><td><th><b>') !!}
                                                                        
                                                                        @endforeach

                                                                            <!-- Medical Futurist is one of the best online resources for learning about technology in the medical sphere. There’s a real sense skepticism uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde in each post from medical doctor and geneticist Mesko, a blog covering new technologies targeted toward numerous specialties. -->
                                                                        </div>
                                                                        <!-- <p>If you run an internet search for medical blogs, you’ll come across hundreds of results. And figuring out which sources are reputable can take a lot of time. To help ease the process, we compiled this list of 55 of our favorite medical blogs everyone in the field can learn from Whether you’re, you’ve been a physician for years, or you simply want to know how make considering medical school well-informed decisions about your own health, there’s something on this list for everyone. Keep this list of medical blogs handy and the answers to your medical away.</p>                                                      -->
                                                                    </div>
                                                                </div>
                                                            </div>

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