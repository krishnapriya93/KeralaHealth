@extends('frontend.layouts.main_header')

<style>
.video-gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    padding: 40px 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.video-item {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
    height: 0;
    overflow: hidden;
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    background-color: #000;
}

.video-item iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
    border-radius: 12px;
}

.gallery-title-section {
    text-align: center;
    margin-top: 40px;
}

.gallery-title-text {
    font-size: 1.5rem;
    font-weight: 600;
    color: #333;
}
</style>

@section('content')

<div class="page-wrapper pbmit-bg-color-light">

    @include('frontend.layouts.main_menu')

    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper gallry_bg">
        <div class="container">
            <div class="pbmit-title-bar-content-inner">
                <div class="pbmit-tbar">
                    <div class="pbmit-tbar-inner container">
                        <h1 class="pbmit-tbar-title">
                            {{ App\Http\Controllers\FrontendController::getSiteControlLabel('photogallery') ?? 'Video Gallery' }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Video Section -->
    <div class="page-content">
        <section class="section-lgx gallery-section">
            <div class="container">

                <div class="video-gallery">
                    <div class="video-item">
                        <iframe src="https://www.youtube.com/embed/mzMqiDLSqbA" allowfullscreen></iframe>
                    </div>
                    <div class="video-item">
                        <iframe src="https://www.youtube.com/embed/mzMqiDLSqbA" allowfullscreen></iframe>
                    </div>
                    <div class="video-item">
                        <iframe src="https://www.youtube.com/embed/mzMqiDLSqbA" allowfullscreen></iframe>
                    </div>
                </div>

            </div>
        </section>
    </div>

    @include('frontend.layouts.main_footer')

</div>

@include('frontend.layouts.search_scroll')
@include('frontend.layouts.include_scripts')

@endsection
