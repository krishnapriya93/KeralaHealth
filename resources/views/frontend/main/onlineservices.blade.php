@extends('frontend.layouts.main_header')

<style>
    .service-title {
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 1rem;
        color: #1a1a1a;
    }

    .service-card {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 20px;
        margin-bottom: 30px;
        background-color: #fdfdfd;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .service-content p {
        text-align: justify;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .service-item {
        padding: 1rem 0;
        border-bottom: 1px dashed #ccc;
    }

    .service-item:last-child {
        border-bottom: none;
    }

    .service-image {
        max-width: 80px;
        height: auto;
    }
</style>

@section('content')

<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    @include('frontend.layouts.main_menu')

    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">
                                {{ App\Http\Controllers\FrontendController::getSiteControlLabel('onlineservices') ?? 'Online Services' }}
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="page-content py-4">
        <div class="container">

            <!-- Search Box -->
            <div class="mb-4">
                <input type="text" id="serviceSearch" class="form-control form-control-lg" placeholder="Search services...">
            </div>

            <div id="onlineServicesList">
                @foreach($onlineservices as $onlineservice)
                <div class="service-card">
                    <h3 class="service-title">{{ $onlineservice->title }}</h3>

                    @foreach($onlineservice->articleval_sub as $articleval_sub)
                    <div class="row service-item align-items-center">
                        <div class="col-md-2 text-center mb-2 mb-md-0">
                            <img src="{{ asset('/assets/backend/uploads/articles/' . $articleval_sub->file) }}" alt="logo" class="img-fluid service-image">
                        </div>
                        <div class="col-md-10">
                            <h5 class="fw-semibold mb-2">{{ $articleval_sub->title }}</h5>
                            <div class="service-content text-muted mb-2">
                                {!! strip_tags($articleval_sub->content, '<font><p><a><ul><li><table><tbody><thead><tr><td><th><b>') !!}
                            </div>
                            @if($onlineservice->service_url)
                                <a href="{{ $onlineservice->service_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                    View Details
                                </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('frontend.layouts.main_footer')

</div>

@include('frontend.layouts.search_scroll')
@include('frontend.layouts.include_scripts')

<script>
    document.getElementById('serviceSearch').addEventListener('input', function () {
        let filter = this.value.toLowerCase();
        let cards = document.querySelectorAll('.service-card');

        cards.forEach(function (card) {
            let text = card.textContent.toLowerCase();
            if (text.includes(filter)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
@endsection
