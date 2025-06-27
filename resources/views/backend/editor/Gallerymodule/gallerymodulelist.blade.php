@extends('backend.layouts.htmlheader')
<style>
    .nav .nav-item button.active {
        background-color: transparent;
        color: var(--bs-danger) !important;
    }

    .nav .nav-item button.active::after {
        content: "";
        border-right: 4px solid var(--bs-danger);
        height: 100%;
        position: absolute;
        right: -1px;
        top: 0;
        border-radius: 5px 0 0 5px;
    }

    /* Hover Shadow Effect */
    .hover-shadow-lg:hover {
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.5);
        transition: all 0.3s ease-in-out;
    }
</style>
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!!$breadcrumbarr!!}
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">

        <div class="container p-5 d-flex align-items-start">
            <ul class="nav nav-pills flex-column nav-pills border-end border-3 me-3 align-items-end" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-primary fw-semibold active position-relative" id="pills-documents-tab" data-bs-toggle="pill" data-bs-target="#pills-documents" type="button" role="tab" aria-controls="pills-documents" aria-selected="false">Documents</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-primary fw-semibold position-relative" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Images</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-primary fw-semibold position-relative" id="pills-videos-tab" data-bs-toggle="pill" data-bs-target="#pills-videos" type="button" role="tab" aria-controls="pills-videos" aria-selected="false">Videos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-primary fw-semibold position-relative" id="pills-pdf-tab" data-bs-toggle="pill" data-bs-target="#pills-pdf" type="button" role="tab" aria-controls="pills-pdf" aria-selected="false">PDF</button>
                </li>
            </ul>

            <div class="tab-content border rounded-3 border-primary p-3 text-danger w-100" id="pills-tabContent">
                <!-- Documents Tab -->
                <div class="tab-pane fade show active" id="pills-documents" role="tabpanel" aria-labelledby="pills-documents-tab">
                    <h2>Documents</h2>
                    <div class="row">

                        @foreach($datas as $data)
                        @foreach($data->suggItems as $item)
                        
                        @if(pathinfo($item->image, PATHINFO_EXTENSION) === 'doc' || pathinfo($item->image, PATHINFO_EXTENSION) === 'docx' || pathinfo($item->image, PATHINFO_EXTENSION) === 'xlsx')
                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                            <div class="card shadow-sm rounded">
                                <a href="{{ asset('/assets/backend/uploads/Suggestionitem/'.$item->image) }}" target="_blank" class="card-img-top d-flex align-items-center justify-content-center p-4 bg-light text-dark rounded-top">
                                    <img src="{{ asset('/assets/backend/uploads/doc.png') }}" alt="Document Icon" class="me-3" style="width: 30px; height: 30px;">
                                    @if(pathinfo($item->image, PATHINFO_EXTENSION) === 'doc' || pathinfo($item->image, PATHINFO_EXTENSION) === 'docx')
                                    <span class="fw-semibold">Download Document</span>
                                    @elseif(pathinfo($item->image, PATHINFO_EXTENSION) === 'xlsx')
                                    <span class="fw-semibold">Sheets</span>
                                    @endif
                                </a>
                                <div class="card shadow-lg mb-4">
                                    <div class="card-body">
                                        <!-- Title -->
                                        <h5 class="card-title text-primary fw-bold">{{ $data->title }}</h5>

                                        <!-- Description -->
                                        <p class="card-text text-muted">{{ $item->description }}</p>

                                        <!-- View Button -->
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <a href="{{ route('editor.docdetails', ['id' => encrypt($item->suggestionid), 'type' => 1]) }}"
                                                class="btn btn-outline-primary btn-sm">
                                                <i class="fa fa-eye me-1"></i> View Details
                                            </a>

                                            <!-- Badge -->
                                            @switch($item->typeId)
                                            @case(0)
                                            <span class="badge bg-info">Suggestion</span>
                                            @break
                                            @case(1)
                                            <span class="badge bg-primary">Announcement</span>
                                            @break
                                            @case(2)
                                            <span class="badge bg-warning">What's New</span>
                                            @break
                                            @case(3)
                                            <span class="badge bg-success">Awards</span>
                                            @break
                                            @case(4)
                                            <span class="badge bg-secondary">Initiatives</span>
                                            @break
                                            @case(5)
                                            <span class="badge bg-dark">Overview</span>
                                            @break
                                            @case(6)
                                            <span class="badge bg-light text-dark">Wellness Tip</span>
                                            @break
                                            @case(7)
                                            <span class="badge bg-danger">Banner</span>
                                            @break
                                            @default
                                            <span class="badge bg-secondary">Unknown</span>
                                            @endswitch
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        @endif
                        @endforeach
                        @endforeach
                    </div>
                </div>
                <!-- Images Tab -->
                <div class="tab-pane fade" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <h2>Images</h2>
                    <div class="row">
                        @foreach($datas as $data)
                        @foreach($data->suggItems as $item)
                        @if(pathinfo($item->image, PATHINFO_EXTENSION) === 'jpg' || pathinfo($item->image, PATHINFO_EXTENSION) === 'png')
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <img src="{{ asset('/assets/backend/uploads/Suggestionitem/'.$item->image) }}" class="card-img-top" alt="{{ $item->title }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $data->title }}</h5>
                                    <p class="card-text">{{ $item->description }}</p>
                                    <!-- View Details Button -->
                                    <a href="{{ route('editor.itemdetails', ['id' => encrypt($item->suggestionid), 'type' => 2]) }}" class="btn btn-primary">View Details</a>
                                    <!-- Badge -->
                                    @switch($item->typeId)
                                    @case(0)
                                    <span class="badge bg-info">Suggestion</span>
                                    @break
                                    @case(1)
                                    <span class="badge bg-primary">Announcement</span>
                                    @break
                                    @case(2)
                                    <span class="badge bg-warning">What's New</span>
                                    @break
                                    @case(3)
                                    <span class="badge bg-success">Awards</span>
                                    @break
                                    @case(4)
                                    <span class="badge bg-secondary">Initiatives</span>
                                    @break
                                    @case(5)
                                    <span class="badge bg-dark">Overview</span>
                                    @break
                                    @case(6)
                                    <span class="badge bg-light text-dark">Wellness Tip</span>
                                    @break
                                    @case(7)
                                    <span class="badge bg-danger">Banner</span>
                                    @break
                                    @default
                                    <span class="badge bg-secondary">Unknown</span>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                    </div>
                </div>

                <!-- Videos Tab -->
                <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">
                    <h2>Videos</h2>
                    <div class="row">
                        @foreach($datas as $data)
                        @foreach($data->suggItems as $item)
                        @if(in_array(pathinfo($item->image, PATHINFO_EXTENSION), ['mp4', 'avi', 'mov'])) <!-- Support for more video types -->
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                <video controls class="card-img-top">
                                    <source src="{{ asset('/assets/backend/uploads/Suggestionitem/'.$item->image) }}" type="video/{{ pathinfo($item->image, PATHINFO_EXTENSION) }}">
                                    Your browser does not support the video tag.
                                </video>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $data->title }}</h5>
                                    <p class="card-text">{{ $item->description }}</p>
                                    <!-- View Details Button -->
                                    <a href="{{ route('editor.itemdetails', ['id' => encrypt($item->suggestionid), 'type' => 3]) }}" class="btn btn-primary">View Details</a>
                                    <!-- Badge -->
                                    @switch($item->typeId)
                                    @case(0)
                                    <span class="badge bg-info">Suggestion</span>
                                    @break
                                    @case(1)
                                    <span class="badge bg-primary">Announcement</span>
                                    @break
                                    @case(2)
                                    <span class="badge bg-warning">What's New</span>
                                    @break
                                    @case(3)
                                    <span class="badge bg-success">Awards</span>
                                    @break
                                    @case(4)
                                    <span class="badge bg-secondary">Initiatives</span>
                                    @break
                                    @case(5)
                                    <span class="badge bg-dark">Overview</span>
                                    @break
                                    @case(6)
                                    <span class="badge bg-light text-dark">Wellness Tip</span>
                                    @break
                                    @case(7)
                                    <span class="badge bg-danger">Banner</span>
                                    @break
                                    @default
                                    <span class="badge bg-secondary">Unknown</span>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                    </div>
                </div>

                <!-- PDF Tab -->
                <div class="tab-pane fade" id="pills-pdf" role="tabpanel" aria-labelledby="pills-pdf-tab">
                    <h2>PDF</h2>
                    <div class="row">
                        @foreach($datas as $data)
                        @foreach($data->suggItems as $item)
                        @if(pathinfo($item->image, PATHINFO_EXTENSION) === 'pdf')
                        <div class="col-md-4 col-sm-6 col-12 mb-3">
                            <div class="card shadow-sm rounded">
                                <a href="{{ asset('/assets/backend/uploads/Suggestionitem/'.$item->image) }}" target="_blank" class="card-img-top d-flex align-items-center justify-content-center p-4 bg-light text-dark rounded-top">
                                    <img src="{{ asset('/assets/backend/uploads/file_16425457.png') }}" alt="Document Icon" class="me-3" style="width: 30px; height: 30px;">
                                    <span class="fw-semibold">Download PDF</span>
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $data->title }}</h5>
                                    <p class="card-text text-muted">{{ $item->description }}</p>
                                    <!-- View Button with Styles -->
                                    <a href="{{ route('editor.docdetails', ['id' => encrypt($item->suggestionid), 'type' => 1]) }}" class="btn btn-primary">View Details</a>
                                    <!-- Badge -->
                                    @switch($item->typeId)
                                    @case(0)
                                    <span class="badge bg-info">Suggestion</span>
                                    @break
                                    @case(1)
                                    <span class="badge bg-primary">Announcement</span>
                                    @break
                                    @case(2)
                                    <span class="badge bg-warning">What's New</span>
                                    @break
                                    @case(3)
                                    <span class="badge bg-success">Awards</span>
                                    @break
                                    @case(4)
                                    <span class="badge bg-secondary">Initiatives</span>
                                    @break
                                    @case(5)
                                    <span class="badge bg-dark">Overview</span>
                                    @break
                                    @case(6)
                                    <span class="badge bg-light text-dark">Wellness Tip</span>
                                    @break
                                    @case(7)
                                    <span class="badge bg-danger">Banner</span>
                                    @break
                                    @default
                                    <span class="badge bg-secondary">Unknown</span>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {
        $(".alert").fadeTo(2000, 500).slideUp(500, function() {
            $(".alert").slideUp(500);
        });

        $('.alert').alert();
    });
</script>
@endsection