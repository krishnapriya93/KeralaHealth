@extends('frontend.layouts.main_header')
<style>
 .announcement-item {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 12px;
}

.calendar-date {
    min-width: 60px;
    min-height: 60px;
    background: #7C9C32; /* Bootstrap blue */
    color: #fff;
    border-radius: 8px;
    text-align: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    display: flex;
    flex-direction: column;
    justify-content: center;
    margin-right: 15px;
    box-shadow: 0 2px 8px rgb(0 123 255 / 0.3);
    user-select: none;
}

.calendar-date .day {
    font-size: 22px;
    font-weight: 700;
    line-height: 1;
}

.calendar-date .month {
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    line-height: 1;
}

.announcement-content a {
    font-weight: 600;
    color: #333;
    text-decoration: none;
    font-size: 16px;
    transition: color 0.3s ease;
}

.announcement-content a:hover {
    color: #7C9C32;
    text-decoration: underline;
}

.announcement-meta {
    font-size: 13px;
    color: #666;
    margin-top: 4px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.announcement-meta i {
    font-size: 14px;
    color: #7C9C32;
}
.calendar-date .year {
    font-size: 12px;
    font-weight: 500;
    opacity: 0.8;
    line-height: 1;
    margin-top: 2px;
}
</style>
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
                    <!-- <div class="col-lg-12 blog-right-col"> -->
                    <div class="col-lg-12">
                        <article class="main-article">
                            <div class="pbmit-ihbox-style-21">
                                <div class="pbmit-ihbox-headingicon">
                                    <div class="pbmit-ihbox-contents w-100">
                                    @foreach($announcements as $announcement)
                                    @foreach($announcement->announcesub as $announcesub)
                                        <div class="news1">
                                      
                                                <ul>
                                                <li class="announcement-item">
                                                    <div class="calendar-date">
                                                        <div class="day">{{ \Carbon\Carbon::parse($announcement->created_at)->format('d') }}</div>
                                                        <div class="month">{{ \Carbon\Carbon::parse($announcement->created_at)->format('M') }}</div>
                                                        <div class="year">{{ \Carbon\Carbon::parse($announcement->created_at)->format('Y') }}</div>
                                                    </div>
                                                    <div class="announcement-content">
                                                        <a href="{{ route('main.announcementitem', \Crypt::encryptString($announcement->id)) }}">
                                                            {{ $announcesub->title ?? '' }}
                                                        </a>
                                                        <!-- <div class="announcement-meta">
                                                            <i class="pbmit-base-icon-calendar-3"></i> {{ \Carbon\Carbon::parse($announcement->created_at)->format('d F Y') }}
                                                        </div> -->
                                                    </div>
                                                </li>


                                                </ul>
                                    
                                        </div>
                                        <hr>
                                        @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </article>
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