@extends('frontend.layouts.main_header')
<style>
.gallery-grid-4 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    padding: 20px;
}

.gallery-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: transform 0.3s ease;
}

.gallery-card:hover {
    transform: translateY(-5px);
}

.gallery-image-wrapper {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 65%; /* Maintain aspect ratio */
}

.gallery-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.gallery-title-section {
    padding: 15px;
    text-align: center;
}

.gallery-title-text {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: #333;
}

.gallery-view-button {
    display: inline-block;
    padding: 6px 12px;
    font-size: 0.9rem;
    background-color:rgb(132, 185, 82);
    color: #fff;
    border-radius: 20px;
    text-decoration: none;
    transition: background 0.3s ease;
}

.gallery-view-button:hover {
    background-color:rgb(40, 145, 63);
}

</style>
@section('content')


<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->
    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper gallry_bg">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">{{ App\Http\Controllers\FrontendController::getSiteControlLabel('photogallery') ?? 'Photo Gallery' }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Title Bar End-->
    <!-- page content -->
    <div class="page-content">

    <section class="section-lgx gallery-section">
    <div class="container">
      
        <div class="gallery-grid-4">
    @foreach($galliers as $gallier)
        @foreach($gallier->gallery_sub as $gallery_sub)
            <div class="gallery-card">
                <div class="gallery-image-wrapper">
                    <img src="{{ asset('/assets/backend/uploads/Gallerymain/' . $gallier->file) }}" 
                         alt="{{ $gallery_sub->title ?? 'Gallery Image' }}" 
                         class="gallery-image">
                </div>
                <div class="gallery-title-section">
                    <p class="gallery-title-text">{{ $gallery_sub->title ?? '' }}</p>
                    <a href="{{ route('main.gallerydetail', ['id' => Crypt::encryptString($gallier->id)]) }}" 
                       class="gallery-view-button">
                        {{ App\Http\Controllers\FrontendController::getSiteControlLabel('viewall') ?? 'View All' }}
                    </a>
                </div>
            </div>
        @endforeach
    @endforeach
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