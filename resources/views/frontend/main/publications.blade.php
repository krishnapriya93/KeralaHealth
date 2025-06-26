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
    <div class="pbmit-title-bar-wrapper publication_bg">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">Publications</h1>
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
                            <div class="card w-100 mb-4">
                                <!-- Title at the top -->
                                <div class="card-header text-center">
                                    <h5 class="mb-0">
                                        {{ $Latestpublication->gallery_sub->first()->title ?? '' }}
                                    </h5>
                                </div>

                                <div class="row g-0 flex-column flex-md-row">
                                    <!-- Image Column -->
                                    <div class="col-md-4 p-3 d-flex align-items-center justify-content-center text-center">
                                        <div style="width: 100%; max-width: 100%; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#imageModal">
                                            <img src="{{ asset('/assets/backend/uploads/Gallerymain/' . $Latestpublication->file) }}"
                                                alt="Card Image"
                                                class="img-fluid rounded"
                                                style="height: 200px; width: 100%; object-fit: cover;">
                                        </div>
                                    </div>

                                    <!-- Documents Column -->
                                    <div class="col-md-8 p-3">
                                        <div class="card-body">
                                            <h6>Downloadable Documents</h6>
                                            <ul class="list-unstyled mb-0">
                                                @forelse($Latestpublication->gallery_item as $gallery_item)
                                                @if(!empty($gallery_item->image))
                                                <li class="mb-2 d-flex align-items-center justify-content-between">
                                                    <span>
                                                        <img src="{{ asset('assets/frontend/images/pdf.png') }}" alt="file" width="18" class="me-2">
                                                        {{ $gallery_item->alternate_text }}
                                                    </span>
                                                    <span>
                                                        <!-- View -->
                                                        <a href="{{ asset('/assets/backend/uploads/Galleryitem/' . $gallery_item->image) }}"
                                                            target="_blank"
                                                            class="me-3"
                                                            title="View File">
                                                            <img src="{{ asset('assets/frontend/images/view.png') }}" alt="View" width="20">
                                                        </a>

                                                        <!-- Download -->
                                                        <a href="{{ asset('/assets/backend/uploads/Galleryitem/' . $gallery_item->image) }}"
                                                            download
                                                            title="Download File">
                                                            <img src="{{ asset('assets/frontend/images/download.gif') }}" alt="Download" width="20">
                                                        </a>
                                                    </span>
                                                </li>
                                                @else
                                                <li class="mb-2">
                                                    <img src="{{ asset('assets/frontend/images/vison.gif') }}" alt="Alert" width="18" class="me-2">
                                                    No documents attached
                                                </li>
                                                @endif
                                                @empty
                                                <li>
                                                    <img src="{{ asset('icons/folder.svg') }}" alt="No files" width="18" class="me-2">
                                                    No files available.
                                                </li>
                                                @endforelse
                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal for Enlarged Image -->
                            <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content bg-transparent border-0">
                                        <div class="modal-body p-0">
                                            <img src="{{ asset('/assets/backend/uploads/Gallerymain/' . $Latestpublication->file) }}"
                                                class="img-fluid w-100 rounded"
                                                alt="Large View">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-12 col-lg-3 blog-left-col">
                        <aside class="sidebar">
                            <aside class="widget widget-recent-post">
                                <h2 class="widget-title">Publications</h2>
                                <ul class="recent-post-list">
                                    @foreach($brouchers as $broucher)
                                    @foreach($broucher->gallery_sub as $gallery_sub)
                                    <li class="recent-post-list-li">
                                        <div class="pbmit-rpw-content">
                                            <span class="pbmit-rpw-date">
                                                <a href="blog-details.html">{{ \Carbon\Carbon::parse($broucher->created_at)->format('F d, Y') }}</a>
                                            </span>
                                            <span class="pbmit-rpw-title">
                                                <a href="{{ route('Publications', ['id' => Crypt::encryptString($broucher->id)]) }}">{{$gallery_sub->title ?? ''}}</a>
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