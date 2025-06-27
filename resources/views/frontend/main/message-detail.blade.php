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
                            <h1 class="pbmit-tbar-title">Message</h1>
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
                        <article class="main-article " style="background-image: url({{asset('assets/frontend/images/pil.jpg') }});background-size: cover;">
                            <div class="post blog-classic ">
                                <div class="pbmit-heading animation-style1">
                                    <h3 class="pbmit-title mb-3">{{$boddetails->bodsub[0]->name}}</h3>
                                    <img class="min-q" src="{{asset('assets/frontend/images/quotes.svg') }}" alt="">
                                </div>
                                <div class="pbmit-blog-classic-inner">
                                    <div class="pbmit-blog-meta pbmit-blog-meta-top">
                                        <span class="pbmit-meta pbmit-meta-date">
                                            Hon.Chief Minister of Kerala
                                        </span>
                                    </div>
                                </div>
                                <div class="pbmit-entry-content  min-det">
                                <p class="pbmit-firstletter"> {!! strip_tags($boddetails->bodsub[0]->description, '<br><strong><em>') !!}.</p>
                              <!--   <p class="pbmit-firstletter">Medical Futurist is one of the best online resources for learning about technology in the medical sphere. There’s a real sense skepticism uis aute irure dolor in reprehenderit in voluptate velit ess cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde in each post from medical doctor and geneticist Mesko, a blog covering new technologies targeted toward numerous specialties.</p> 
                                    <p>If you run an internet search for medical blogs, you’ll come across hundreds of results. And figuring out which sources are reputable can take a lot of time. To help ease the process, we compiled this list of 55 of our favorite medical blogs everyone in the field can learn from Whether you’re, you’ve been a physician for years, or you simply want to know how make considering medical school well-informed decisions about your own health, there’s something on this list for everyone. Keep this list of medical blogs handy and the answers to your medical away.</p> 
                                    <br> -->
                                    @if ($boddetails->id == 7)
                                    <div class="sign">
                                        <img src="{{asset('assets/frontend/images/sign1.png') }}" alt="">
                                    </div>
                                    @elseif($boddetails->id == 8)
                                    <div class="sign">
                                        <img src="{{asset('assets/frontend/images/sign2.png') }}" alt="">
                                    </div>
                                    @elseif($boddetails->id == 9)
                                    <div class="sign">
                                        <img src="{{asset('assets/frontend/images/sign3.png') }}" alt="">
                                    </div>
                                    @endif
                                    
                                </div>
                                @if ($boddetails->id == 7)
                                <div class="minist">
                                    <img src="{{asset('assets/frontend/images/t1.png') }} " alt="">
                                </div>
                                    @elseif($boddetails->id == 8)
                                    <div class="minist">
                                    <img src="{{asset('assets/frontend/images/t2.png') }} " alt="">
                                </div>
                                    @elseif($boddetails->id == 9)
                                    <div class="minist">
                                    <img src="{{asset('assets/frontend/images/t3.png') }} " alt="">
                                </div>
                                    @endif
                               
                            </div>

                        </article>
                    </div>
                    <div class="col-md-12 col-lg-3 blog-left-col">
                        <aside class="sidebar">
                            <aside class="widget widget-recent-post">

                                <ul class="recent-post-list">
                                    @foreach($allboddetails as $allboddetail)
                                    @foreach($allboddetail->bodsub as $bodsubs)
                                    <li class="recent-post-list-li">
                                        <div class="pbmit-rpw-content">
                                            <h6 class="widget-title1 mb-1">{{$bodsubs->name}}</h6>
                                            <span class="pbmit-rpw-date">
                                            @foreach ($allboddetail->designation as $designation)
                                                @foreach ($designation->des_sub as $des_sub)
                                                    <a href="{{ route('main.dobmessage-detail',\Crypt::encryptString($allboddetail->id)) }}">{{$des_sub->title}}</a>
                                                @endforeach
                                            @endforeach
                                               
                                            </span>
                                            <span class="pbmit-rpw-titl square">
                                                <img src="{{asset('/assets/backend/uploads/bod/'.$allboddetail->photo)}}" width="90" alt="">
                                                <p>
                                                {!! Str::limit(strip_tags($bodsubs->description, '<br><strong><em>'), 50) !!}
                                                </p>

                                            </span>
                                            <div class="text-end">
<a href="{{ route('main.dobmessage-detail', \Crypt::encryptString($allboddetail->id)) }}" class="moree">Read More</a>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                    @endforeach

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
    @include('frontend.layouts.main_footer')

</div>
<!-- page wrapper End -->


@include('frontend.layouts.search_scroll')

<!-- JS
		============================================ -->
<!-- jQuery JS -->
@include('frontend.layouts.include_scripts')

@endsection