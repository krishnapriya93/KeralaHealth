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
    <div class="pbmit-title-bar-wrapper department-bg">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">
                            <h1 class="pbmit-tbar-title">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('department') ?? 'Departments' }} </h1>
                        </div>
                    </div>
                   
                    <!-- <div class="pbmit-breadcrumb">
                                <div class="pbmit-breadcrumb-inner">
                                    <span>
                                        <a title="" href="#" class="home"><span>Xcare</span></a>
                                    </span>
                                    <span class="sep">
                                        <i class="pbmit-base-icon-angle-double-right"></i>
                                    </span>
                                    <span><span class="post-root post post-post current-item">Dentist</span></span>
                                    <span class="sep">
                                        <i class="pbmit-base-icon-angle-double-right"></i>
                                    </span>
                                    <span><span class="post-root post post-post current-item"> The Most important Ventilator Equipment available</span></span>
                                </div>
                            </div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Title Bar End-->
    <!-- page content -->
    <div class="page-content">

        <section class="section-lgx pbmit-sortable-yes">
            <div class="container">
                <div class="d-xl-flex align-items-center justify-content-between">
                    <div class="pbmit-heading-subheading">
                        <!-- <h2 class="{{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1' }}">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('department') ?? 'Departments' }}</h2> -->
                    </div>
                    <div class="pbmit-sortable-list pbmit-sortable-list-style-1">
                        <ul class="pbmit-sortable-list-ul">
                            <li><a href="#" class="pbmit-sortable-link pbmit-selected" data-sortby="*" value="1">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('all') ?? 'All' }}</a></li>
                            <li><a href="#" class="pbmit-sortable-link" data-sortby="health" value="2">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('healthdept') ?? 'Health Department' }}</a></li>
                            <li><a href="#" class="pbmit-sortable-link" data-sortby="ayush" value="3">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('ayushdept') ?? 'Ayush Department' }}</a></li>
                        </ul>
                    </div>
                </div>

                <div class="pbmit-element-posts-wrapper row" id="office-container">
                    <!-- Add a data-category attribute to each article for easy filtering -->
                  
                    @foreach($officelists as $officelist)
                        @foreach($officelist->office_sub as $office_sub)
                            @php
                                $FormatTitle = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $office_sub->title));
                            @endphp
                            <article class="pbmit-product-style-1 col-md-4 col-lg-3" data-category="health">
                                <div class="product h-100">
                                    <a href="{{ route('main.department-details', ['title' => $FormatTitle, 'id' => Crypt::encryptString($officelist->id)]) }}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                        <img src="{{ asset('/assets/backend/uploads/Officelogo/' . $officelist->logo) }}" class="attachment-woocommerce_thumbnail" alt="">
                                        <!-- <h2 class="woocommerce-loop-product__title">{{ \Illuminate\Support\Str::title($office_sub->title) }}</h2> -->
                                        <h2 class="woocommerce-loop-product__title">
                                            {{
                                                \Illuminate\Support\Str::of($office_sub->title)
                                                    ->title() // Capitalize each word
                                                    ->replaceMatches('/\((.*?)\)/', function ($match) {
                                                        return '(' . strtoupper($match[1]) . ')';
                                                    })
                                            }}
                                        </h2>

                                    </a>
                                    <a href="{{ route('main.department-details', ['title' => $FormatTitle, 'id' => Crypt::encryptString($officelist->id)]) }}" class="button"></a>
                                </div>
                            </article>
                        @endforeach
                    @endforeach

                    
                    <!-- More articles... -->
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

<!-- JS
		============================================ -->
<!-- jQuery JS -->
@include('frontend.layouts.include_scripts')
<script type="text/javascript">
    $(document).ready(function () {
    $(".pbmit-sortable-link").on("click", function (e) {

        e.preventDefault(); // Prevent default anchor behavior

        var value = $(this).attr("value"); // Get the value attribute

        $.ajax({
        url: "{{ route('departmentsort') }}", // Replace with your actual route URL
        type: "POST", // Use GET or POST as needed
        data: {
            value: value,
            _token: $('meta[name="csrf-token"]').attr("content") // CSRF token for Laravel
        },
        beforeSend: function () {
            $("#office-container").html(""); // Clear the div before loading new content
        },
        success: function (response) {
                console.log("AJAX Response:", response); // Debugging

                if (!response || response.length === 0) {
                    $("#office-container").html('<p>No data available.</p>');
                    return;
                }
                
                let html = "";
                response.forEach(officelist => {
                    if (officelist.office_sub) { // Ensure office_sub exists
                        officelist.office_sub.forEach(office_sub => {
                            let formatTitle = office_sub.title.replace(/[^A-Za-z0-9_]/g, '').replace(/\s/g, '_');
                            let url = `/department-details/${formatTitle}/${officelist.id}`;

                            html += `
                                <article class="pbmit-product-style-1 col-md-4 col-lg-3" data-category="health">
                                    <div class="product">
                                        <a href="${url}" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">
                                            <img src="/assets/backend/uploads/Officelogo/${officelist.logo}" class="attachment-woocommerce_thumbnail" alt="">
                                            <h2 class="woocommerce-loop-product__title">${office_sub.title}</h2>
                                        </a>
                                    </div>
                                </article>
                            `;
                        });
                    }
                });
                $("#office-container").html(html); // Update content
},
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
        //     $("#office-container").html(response); // Update the office list

        // },
        // error: function (xhr, status, error) {
        //     console.error(error);
        //     console.log("An error occurred.");
        // }
    });

    });
});

</script>
@endsection