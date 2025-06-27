@extends('frontend.layouts.main_header')

<style>
    .show-more-btn {
        background: linear-gradient(135deg, #4caf50, #81c784);
        color: white;
        border: none;
        padding: 12px 24px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 30px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        display: block;
        margin: 20px auto;
        position: relative;
        overflow: hidden;
    }

    .show-more-btn:hover {
        background: linear-gradient(135deg, #388e3c, #66bb6a);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
        transform: translateY(-2px);
    }

    .show-more-btn .icon {
        display: inline-block;
        margin-right: 8px;
        transition: transform 0.3s ease;
    }

    .show-more-btn:hover .icon {
        transform: rotate(180deg);
    }

    /* Style search input */
    #financialAidSearch {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        font-size: 16px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
</style>

@section('content')

<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    @include('frontend.layouts.main_menu')

    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper article_bg">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">
                                @if($title == 'SchemesforMothers')
                                    {{  App\Http\Controllers\FrontendController::getSiteControlLabel('SchemesforMothers') ?? 'Schemes for Mothers' }}
                                @elseif($title == 'SchemesforChildren')
                                  {{  App\Http\Controllers\FrontendController::getSiteControlLabel('SchemesforChildren') ?? 'Schemes for Children' }}
                                @elseif($title =='OtherSchemes')
                                  {{  App\Http\Controllers\FrontendController::getSiteControlLabel('OtherSchemes') ?? 'Other Schemes' }}
                                @endif
                            </h1>
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

                    <div class="col-lg-12">
                        <article class="main-article">
                            <div class="pbmit-ihbox-style-21">
                                <div class="pbmit-ihbox-headingicon">
                                    <div class="pbmit-ihbox-contents w-100">

                                        {{-- Search Input --}}
                                        <input type="text" id="financialAidSearch" placeholder="Search Financial Aids...">

                                        @php
                                        $count = 0;
                                        $shown = 0;
                                        @endphp

                                        {{-- Show first 5 --}}
                                        @foreach($SchemesDatas as $SchemesData)
                                            @foreach($SchemesData->announcesub as $announcesub)
                                                @if($count < 5)
                                                    <div class="news1">
                                                        <ul>
                                                            <li class="img-ico">
                                                                <img src="{{ asset('assets/frontend/images/finaid2.avif') }}" alt="">
                                                            </li>
                                                            <li class="financial-aid-title">
                                                                <a href="{{ route('main.Sechmeitem', [\Crypt::encryptString($SchemesData->id),$title ]) }}">
                                                                    {{ $announcesub->title ?? '' }}
                                                                </a>
                                                            </li>
                                                        </ul>
                                                        <hr>
                                                    </div>
                                                    @php $count++; @endphp
                                                @endif
                                            @endforeach
                                        @endforeach

                                        {{-- Hidden items --}}
                                        <div id="moreFinancialAid" style="display: none;">
                                            @foreach($RelatedSchemes as $RelatedScheme)
                                                @foreach($RelatedScheme->announcesub as $announcesub)
                                                    @php $shown++; @endphp
                                                    @if($shown > 5)
                                                        <div class="news1">
                                                            <ul>
                                                                <li class="img-ico">
                                                                    <img src="{{ asset('assets/frontend/images/mic.png') }}" alt="">
                                                                </li>
                                                                <li class="financial-aid-title">
                                                                    <a href="#">{{ $announcesub->title }}</a>
                                                                </li>
                                                            </ul>
                                                            <hr>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>

                                        {{-- Show More Button --}}
                                        @if($shown > 5)
                                            <button class="show-more-btn" onclick="document.getElementById('moreFinancialAid').style.display='block'; this.style.display='none';">
                                                <span class="icon">+</span> Show More
                                            </button>
                                        @endif

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

    @include('frontend.layouts.main_footer')

</div>
<!-- page wrapper End -->

@include('frontend.layouts.search_scroll')
@include('frontend.layouts.include_scripts')

{{-- Search and Show More Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('financialAidSearch');
        searchInput.addEventListener('input', function () {
            const filter = this.value.toLowerCase();

            // Select all news items (both visible and hidden)
            const newsItems = document.querySelectorAll('.news1');

            newsItems.forEach(item => {
                const titleElement = item.querySelector('.financial-aid-title a');
                if (!titleElement) return;

                const text = titleElement.textContent.toLowerCase();

                if (text.includes(filter)) {
                    item.style.display = '';
                } else {
                    item.style.display = 'none';
                }
            });

            // Handle Show More button visibility and hidden section
            const showMoreBtn = document.querySelector('.show-more-btn');
            const moreSection = document.getElementById('moreFinancialAid');

            if (showMoreBtn) {
                if (filter.length > 0) {
                    // Hide show more button and reveal all hidden items to allow searching them
                    showMoreBtn.style.display = 'none';
                    if (moreSection) moreSection.style.display = 'block';
                } else {
                    // Reset when search is cleared
                    showMoreBtn.style.display = '';
                    if (moreSection) moreSection.style.display = 'none';
                }
            }
        });
    });
</script>

@endsection
