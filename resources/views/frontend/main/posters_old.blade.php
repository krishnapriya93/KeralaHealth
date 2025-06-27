@extends('frontend.layouts.main_header')
<style>
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 15px;
}

.gallery-item {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    height: 250px; /* Set your preferred height */
    background-color: #eee;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.gallery-img-wrapper {
    width: 100%;
    height: 100%;
    position: relative;
}

.gallery-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
    display: block;
}

.gallery-item:hover .gallery-img {
    transform: scale(1.05);
}

.gallery-overlay {
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.5);
    opacity: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-text {
    text-align: center;
    color: white;
}

.btn-view {
    background: #fff;
    color: #000;
    padding: 6px 14px;
    border-radius: 20px;
    text-decoration: none;
    font-weight: bold;
}

.btn-view:hover {
    background: #000;
    color: #fff;
}

</style>
@section('content')


<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->
    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper publication_bg">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">{{ App\Http\Controllers\FrontendController::getSiteControlLabel('iecmaterials') ?? 'IEC Materials' }}</h1>
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
      
        <div class="gallery-grid">
            @foreach($iecmaterials as $iecmaterial)
                @foreach($iecmaterial->gallery_sub as $gallery_sub)
            
                    <div class="gallery-item">
                        <div class="gallery-img-wrapper">
                            <img src="{{ asset('/assets/backend/uploads/Gallerymain/' . $iecmaterial->file) }}" alt="" class="gallery-img">
                            <div class="gallery-overlay">
                                <div class="gallery-text">
                                    <a href="{{ route('main.iecmaterialsdetail', ['id' => Crypt::encryptString($iecmaterial->id)]) }}" class="btn-view">
                                        {{ App\Http\Controllers\FrontendController::getSiteControlLabel('viewall') ?? 'View All' }}
                                    </a>
                                    <p class="gallery-title">{{ $gallery_sub->title ?? '' }}</p>
                                </div>
                            </div>
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