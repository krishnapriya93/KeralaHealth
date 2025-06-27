@extends('frontend.layouts.main_header')
<style>
    .vAll {
    background: var(--pbmit-global-color);
    padding: 6px 11px;
    font-size: 14px;
    margin-bottom: 3px;
    color: #fff;
    border-radius: 4px;
}
</style>
@section('content')


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
                            <h1 class="pbmit-tbar-title">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('iecmaterials') ?? 'IEC Materials' }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Title Bar End-->
    <!-- page content -->
    <div class="page-content">

    <section class="section-lgx pbmit-column-four">
                <div class="container myGal">
                    <div class="row pbmit-element-posts-wrapper">
                        @foreach($iecmaterials as $iecmaterial)
                        @foreach($iecmaterial->gallery_sub as $gallery_sub)
                        <article class="pbmit-portfolio-style-1 col-md-6 col-lg-3">
                            <div class="pbminfotech-post-content">
                                <div class="pbmit-featured-img-wrapper">
                                    <div class="pbmit-featured-wrapper">
                                        <img src="{{ asset('/assets/backend/uploads/Gallerymain/' . $iecmaterial->file) }}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="pbminfotech-box-content">
                                    <div class="pbminfotech-titlebox">
                                        <a href="{{ route('main.iecmaterialsdetail', ['id' => Crypt::encryptString($iecmaterial->id)]) }}" class="vAll">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('viewall') ?? 'View All' }}</a>
                                        <div class="pbmit-port-cat mt-2">
                                            <a href="portfolio-grid-col-3.html" rel="tag"> {{$gallery_sub->title ?? ''}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
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