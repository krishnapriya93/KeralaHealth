@extends('frontend.layouts.main_header')

<style>
    #gallery .img-wrapper {
        position: relative;
        margin-top: 15px;
        overflow: hidden;
        border-radius: 8px;
    }

    #gallery .img-overlay {
        background: rgba(0, 0, 0, 0.7);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.4s ease-in-out;
    }

    .img-wrapper:hover .img-overlay {
        opacity: 1;
    }

    .gallery-video {
        border-radius: 8px;
        overflow: hidden;
    }

    .img-wrapper {
        position: relative;
        transition: transform 0.2s ease-in-out;
    }

    .img-wrapper:hover {
        transform: scale(1.03);
    }

 .iframe-container {
    position: relative;
    width: 90vw;
    max-width: 900px;
    margin: 40px auto;
    /* 16:9 Aspect Ratio = 9/16 = 56.25% */
    padding-bottom: 56.25%; 
    height: 0;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #ddd;
    background: #fff;
}

.iframe-container iframe {
    position: absolute;
    top: 0; 
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
    border-radius: 16px;
    display: block;
}


</style>

@section('content')

<div class="page-wrapper pbmit-bg-color-light">

    @include('frontend.layouts.main_menu')

    <div class="pbmit-title-bar-wrapper article_bg">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">
                                {{ App\Http\Controllers\FrontendController::getSiteControlLabel('posters') ?? 'Posters' }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="page-content">
        <section id="gallery" class="mb-4">
            <div class="container">
                <div id="image-gallery">
                    <div class="row mt-3">
                        @foreach($iecmaterials->gallery_sub as $gallery_sub)

                        <h2 class="widget-title">{{ $gallery_sub->title }}</h2>

                        @endforeach
                    </div>

                    <div class="row">
                        <div class="me-2">
                            <!-- @foreach($iecmaterials->gallery_sub as $gallery_sub)  {{$gallery_sub->title}} @endforeach -->
                        </div>
                        @foreach($iecmaterials->gallery_item as $gallery_item)
                        @php
                        $filePath = asset('/assets/backend/uploads/Galleryitem/' . $gallery_item->image);
                        $extension = pathinfo($gallery_item->image, PATHINFO_EXTENSION);
                        @endphp

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 image mb-4">
                            <div class="img-wrapper border rounded shadow-sm p-2 text-center">
                                <div class="mb-2 fw-semibold">{{ $gallery_item->title ?? '' }}</div>

                               @if($extension == 'mp4')
    <div class="ratio ratio-16x9 gallery-video">
        <video controls class="w-100 rounded">
            <source src="{{ $filePath }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
@elseif(strtolower($extension) == 'pdf')
<div class="iframe-container">
    <iframe 
        src="{{ $filePath }}" 
        frameborder="0" 
        allowfullscreen
    ></iframe>
</div>


@else
    <a href="#" class="gallery-item" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ $filePath }}">
        <img src="{{ $filePath }}" class="img-fluid rounded" alt="Gallery Image">
    </a>
@endif


                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Image Modal --}}
            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content bg-dark">
                        <div class="modal-body text-center p-0">
                            <img src="" id="modalImage" class="img-fluid w-100 rounded" alt="">
                        </div>
                    </div>
                </div>
            </div>
            @php
            $url = $currentUrl;
            $title = $title;
            @endphp
            <div class="d-flex justify-content-center">
                <div class="share-buttons d-inline-flex align-items-center gap-2">
                    <span class="me-2">Share this article:</span>
                    <a href="https://wa.me/?text={{ urlencode($title) }}%20{{ urlencode($url) }}" target="_blank" title="Share on WhatsApp">
                        <img src="{{ asset('assets/frontend/images/whatsapp.png') }}" alt="WhatsApp" style="width:32px; height:32px;">
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($url) }}" target="_blank" title="Share on Facebook">
                        <img src="{{ asset('assets/frontend/images/facebook.png') }}" alt="Facebook" style="width:32px; height:32px;">
                    </a>
                </div>
            </div>


        </section>

    </div>

    @include('frontend.layouts.main_footer')

</div>

@include('frontend.layouts.search_scroll')

<!-- Bootstrap Modal for Image Lightbox -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <img id="modalImage" class="img-fluid rounded shadow-lg" src="" alt="Gallery Image">
            </div>
        </div>
    </div>
</div>

@include('frontend.layouts.include_scripts')

<script>
    $(document).ready(function() {
        // When an image is clicked, update the modal image
        $(".gallery-item").click(function(event) {
            event.preventDefault();
            var imageSrc = $(this).attr("data-image");
            $("#modalImage").attr("src", imageSrc);
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const modalImage = document.getElementById("modalImage");

        document.querySelectorAll(".gallery-item").forEach(item => {
            item.addEventListener("click", function() {
                const imgSrc = this.getAttribute("data-image");
                modalImage.setAttribute("src", imgSrc);
            });
        });
    });
  
</script>

@endsection