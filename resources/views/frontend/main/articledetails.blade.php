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
        /* Optional: clean up and improve visuals */
        .custom-article-content table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1rem;
    overflow-x: auto;
}

.custom-article-content th,
.custom-article-content td {
    border: 1px solid #dee2e6;
    padding: 0.75rem;
    text-align: center;
    vertical-align: middle;
    word-break: break-word;
}

.custom-article-content thead {
    background-color: #f8f9fa;
    font-weight: bold;
}

.custom-article-content tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Responsive tweaks */
@media (max-width: 768px) {
    .custom-article-content table,
    .custom-article-content thead,
    .custom-article-content tbody,
    .custom-article-content th,
    .custom-article-content td,
    .custom-article-content tr {
        display: block;
        width: 100%;
    }

    .custom-article-content tr {
        margin-bottom: 1rem;
    }

    .custom-article-content td {
        text-align: left;
        padding-left: 50%;
        position: relative;
    }

    .custom-article-content td::before {
        position: absolute;
        left: 1rem;
        top: 0.75rem;
        white-space: nowrap;
        font-weight: bold;
        content: attr(data-label);
    }

    .custom-article-content th {
        display: none;
    }
}


</style>

<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->
    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper article_bg">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">{{ $Articletype->articletype_sub[0]->title }}</h1>
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
                                    <div class="col-sm-12 col-md-3">
                                        <div class="pbmit-sticky-cl">
                                            <div class="pbmit-team-left-inner">
                                                <div class="pbmit-featured-wrapper">
                                                @foreach($articles->articleval_sub as $articleval_sub)
                                                @if(!empty($articleval_sub->file))
                                                    <img src="{{ asset('/assets/backend/uploads/articles/' . $articleval_sub->file) }}" class="img-fluid w-100" alt="" style="border-radius: 30px 30px 0 0;">
                                                @else
                                                <img src="{{ asset('/assets/frontend/images/Subtract2.png') }}" class="img-fluid w-100" alt="" style="border-radius: 30px 30px 0 0;">
                                                @endif
                                                @endforeach
                                         
                                                </div>
                                                <!-- <div class="pbmit-team-detail">
                                                    <div class="pbmit-team-detail-inner">
                                                        <div class="pbmit-team-summary">
                                                            <h2 class="pbmit-team-title text-center"> @foreach($articles->articleval_sub as $articleval_sub)
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
                                                    <h3 class="mb-2 {{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1' }}" style="font-weight: 500;font-size: 30px;"> @foreach($articles->articleval_sub as $articleval_sub)
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
                                                            
                                                                      
                                                                        <div class="pbmit-firstletter custom-list" style="text-align: justify;">
                                                                        @foreach($articles->articleval_sub as $articleval_sub)
                                                                        <!-- {!! strip_tags($articleval_sub->content, '<font><p><a><ul><li><table><tbody><thead><tr><td><th><b><strong><em><br>') !!} -->
                                                                        <div class="row mb-2">
                                                                            <div class="col-sm-12 d-flex justify-content-center">
                                                                                <div class="table-responsive w-100" style="max-width: 90%;">
                                                                                    <div class="custom-article-content pbmit-firstletter custom-list">
                                                                                        {!! strip_tags($articleval_sub->content, '<font><p><a><ul><li><table><tbody><thead><tr><td><th><b><strong><em><br>') !!}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <!-- {!! strip_tags($articleval_sub->content, '<font><p><a><ul><li><table><tbody><thead><tr><td><th><b>') !!} -->
                                                                        @endforeach
                                                                        @php
                                                                        $url = $currentUrl;
                                                                        $title = urlencode($articleval_sub->title);
                                                                    @endphp

                                                                    <div class="share-buttons" style="display: inline-flex; align-items: center; gap: 10px;">
    <span>Share this article:</span>
    <a href="https://wa.me/?text={{ urlencode($title) }}%20{{ urlencode($url) }}" target="_blank" title="Share on WhatsApp">
        <img src="{{ asset('assets/frontend/images/whatsapp.png') }}" alt="WhatsApp" style="width:32px; height:32px;">
    </a>
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" target="_blank" title="Share on Facebook">
        <img src="{{ asset('assets/frontend/images/facebook.png') }}" alt="Facebook" style="width:32px; height:32px;">
    </a>
</div>






                                                                            <!-- Medical Futurist is one of the best online resources for learning about technology in the medical sphere. There’s a real sense skepticism uis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde in each post from medical doctor and geneticist Mesko, a blog covering new technologies targeted toward numerous specialties. -->
                                                                        </div>
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
                                    <h2 class="widget-title">Recent {{ $Articletype->articletype_sub[0]->title }}</h2>
                                        <ul class="recent-post-list">
                                            
                                        @foreach($recentarticles as $recentarticle)                 
                                        @foreach($recentarticle->articleval_sub as $articleval_sub)
                                            @php 
                                            $FormatTitle   = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $articleval_sub->title));
                                            $articleTypeId = $recentarticle->articletype_id;
                                            $url = route('main.recentarticledetail', ['id' => Crypt::encryptString($articleTypeId)]);
                                            @endphp
                    
                                            <li class="recent-post-list-li"> 
                                                <a class="recent-post-thum" href="{{ route('main.articledetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($recentarticle->id) ]) }}">
                                                @if(!empty($articleval_sub->file))
                                                    <img src="{{ asset('/assets/backend/uploads/articles/' . $articleval_sub->file) }}" class="img-fluid w-100" alt="" style="border-radius: 30px 30px 0 0;">
                                                @else
                                                <img src="{{ asset('/assets/frontend/images/Subtract2.png') }}" class="img-fluid w-100" alt="" style="border-radius: 30px 30px 0 0;">
                                                @endif
                                                <!-- <img src="{{asset('/assets/backend/uploads/articles/'.$articleval_sub->file)}}" class="img-fluid" alt=""> -->
                                                </a>
                                                <div class="pbmit-rpw-content">
                                                    <span class="pbmit-rpw-date">
                                                        <a href="{{ route('main.articledetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($recentarticle->id) ]) }}">{{ \Carbon\Carbon::parse($recentarticle->created_at)->format('F d, Y') }}</a>
                                                    </span>
                                                    <span class="pbmit-rpw-title">
                                                        <a href="{{ route('main.articledetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($recentarticle->id) ]) }}">{{$articleval_sub->title}}</a>
                                                    </span>
                                                </div> 
                                            </li>
                                            @endforeach
                                            @endforeach
                                        </ul>
                                        <div class="view-all w-x mt-3">
                                            <a href="{{ $url ?: '#' }}"> {{  App\Http\Controllers\FrontendController::getSiteControlLabel('viewall') ?? 'View All' }}</a>
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