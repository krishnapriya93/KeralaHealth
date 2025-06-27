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
                            <h1 class="pbmit-tbar-title">Financial Aid</h1>
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
                                    <h3 class="pbmit-title mb-3">{{ $announcementitem->announcesub[0]->title }}</h3>
                                </div>
                                <div class="pbmit-blog-classic-inner">
                                    <div class="pbmit-blog-meta pbmit-blog-meta-top">
                                        <span class="pbmit-meta pbmit-meta-date">
                                            <i class="pbmit-base-icon-calendar-3"></i>&nbsp;{{ \Carbon\Carbon::parse($announcementitem->s_date)->format('d F Y') }}
                                        </span>
                                        <!-- <span class="pbmit-meta pbmit-meta-author">
                                                        <i class="pbmit-base-icon-user-3"></i>by admin
                                                    </span>
                                                    <span class="pbmit-meta pbmit-meta-comments pbmit-comment-bigger-than-zero">
                                                        <i class="pbmit-base-icon-chat-3"></i>3 Comments
                                                    </span>			 -->
                                    </div>
                                    <div class="pbmit-entry-content">
                                        <p class="pbmit-firstletter">{!! $announcementitem->announcesub[0]->description !!}</p>


                                    </div>
                                </div>
                            </div>

                        </article>
                    </div>
                    <div class="col-md-12 col-lg-3 blog-left-col">
                        <aside class="widget">
                            <div class="textwidget">
                                <div class="download">
                                    <div class="item-download">
                                        <a href="{{ route('main.financialaiditemPDF', \Crypt::encryptString($announcementitem->id)) }}" target="_blank" rel="noopener noreferrer">
                                            <span class="pbmit-download-content">
                                                <i class="pbmit-base-icon-pdf-file-format-symbol-1"></i> Download Pdf File
                                            </span>
                                            <span class="pbmit-download-item">
                                                <img src="{{ asset('assets/frontend/images/download.gif') }} " width="40" height="40" alt="">
                                            </span>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </aside>
                        <aside class="sidebar">
                            <aside class="widget widget-recent-post">
                                <h2 class="widget-title">Related Financial Aid</h2>
                                <ul class="recent-post-list">
                                    @foreach($RelatedFinAids as $RelatedFinAid)
                                    @foreach($RelatedFinAid->announcesub as $announcesub)

                                    <li class="recent-post-list-li flex items-start gap-4 mb-4">
                                        <!-- Image -->
 
                                        <img src="{{ asset('assets/frontend/images/loudspeaker.png') }}" alt="View" width="20">
                                        <!-- Content -->
                                        <div class="pbmit-rpw-content">
                                            <span class="pbmit-rpw-date text-sm text-gray-500 block mb-1">
                                                <a href="{{ route('main.financialaiditem', \Crypt::encryptString($RelatedFinAid->id)) }}">
                                                    {{ \Carbon\Carbon::parse($announcementitem->s_date)->format('d F Y') }}
                                                </a>
                                            </span>
                                            <span class="pbmit-rpw-title text-base font-medium text-gray-800 leading-tight">
                                                <a href="{{ route('main.financialaiditem', \Crypt::encryptString($RelatedFinAid->id)) }}">{{ $announcesub->title ?? '' }}</a>
                                            </span>
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

<!-- JS-->


@include('frontend.layouts.include_scripts')

@endsection