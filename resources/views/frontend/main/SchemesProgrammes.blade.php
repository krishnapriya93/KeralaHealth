@extends('frontend.layouts.main_header')
<style>
    .rads .btn-outline-primary {
        border-color: var(--pbmit-global-color);
        color: var(--pbmit-global-color);
        background-color: #fff;
    }

    .rads .btn-check:checked+.btn {
        color: var(--bs-btn-active-color);
        background-color: var(--pbmit-global-color);
        border-color: var(--pbmit-global-color);
    }

    .mySelect .form-select {
        font-size: 16px;
        font-weight: 500;
        padding: 0 100px 0 30px;
        height: 44px;
        border: 1px solid #c8c8c8;
        border-radius: 6px;
        cursor: pointer;
        color: var(--pbmit-heading-color);
        background-color: #ffffff;
        font-weight: 400;
    }

    .btn-group>.btn-group:not(:first-child)>.btn,
    .btn-group>.btn:nth-child(n+3),
    .btn-group>:not(.btn-check)+.btn {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .btn-group>.btn-group:not(:first-child),
    .btn-group>.btn:not(:first-child) {
        margin-left: -1px;
    }

    .btn-group-vertical>.btn-check:checked+.btn,
    .btn-group-vertical>.btn-check:focus+.btn,
    .btn-group-vertical>.btn.active,
    .btn-group-vertical>.btn:active,
    .btn-group-vertical>.btn:focus,
    .btn-group-vertical>.btn:hover,
    .btn-group>.btn-check:checked+.btn,
    .btn-group>.btn-check:focus+.btn,
    .btn-group>.btn.active,
    .btn-group>.btn:active,
    .btn-group>.btn:focus,
    .btn-group>.btn:hover {
        z-index: 1;
    }
</style>
@section('content')

<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    <!-- Header Main Area start Here -->
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->
    <!-- Header Main Area End Here -->
    <!-- Title Bar -->
    <div class="pbmit-title-bar-wrapper article_bg">
        <div class="container">
            <div class="pbmit-title-bar-content">
                <div class="pbmit-title-bar-content-inner">
                    <div class="pbmit-tbar">
                        <div class="pbmit-tbar-inner container">

                            <h1 class="pbmit-tbar-title">
                                @if($id == "scheme")
                                {{ App\Http\Controllers\FrontendController::getSiteControlLabel('schemes') ?? 'Schemes and Programmes 1' }}
                                @elseif($id == "campaigns")
                                {{ App\Http\Controllers\FrontendController::getSiteControlLabel('campaigns') ?? 'Campaigns' }}
                                @elseif($id == "medicaleducation")
                                {{ App\Http\Controllers\FrontendController::getSiteControlLabel('medicaleducation') ?? 'Medical Education' }}
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
        <section class="section-lgx pbmit-sortable-yes">
            <div class="container">
                <div class="">
                    <!-- <div class="pbmit-heading-subheading">
                            <h3 class="pbmit-title">Departments</h3>
                        </div> -->
                    <!-- <div class="pbmit-sortable-list pbmit-sortable-list-style-1">
                            <ul class="text-start pbmit-sortable-list-ul">
                                <li><a href="#" class="pbmit-sortable-link pbmit-selected" >Health Department</a></li>
                                <li><a href="#" class="pbmit-sortable-link" >Ayush Department</a></li>
                            </ul>
                        </div> -->
                    <!-- <div class="radios d-flex">
                            <div class="form-check me-4">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Health Department
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" >
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Ayush Department
                                </label>
                              </div>
                        </div> -->
<!-- 
                  <div class="rads btn-group mb-3" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check depId" name="btnradio" id="btnradio1" value="1" autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="btnradio1">Health</label>

                        <input type="radio" class="btn-check depId" name="btnradio" id="btnradio2" value="2" autocomplete="off">
                        <label class="btn btn-outline-primary" for="btnradio2">Ayush</label>
                    </div>
                                         -->
                    <!-- <div class="col-lg-4 mySelect yourTargetDiv">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Department</option>

                            @foreach($officelists as $officelist)
                            @foreach($officelist->office_sub as $office_sub)
                            <option value="1">{{$office_sub->title}}</option>
                            @endforeach
                            @endforeach


                        </select>
                    </div> -->
                </div>
             
               
       <div id="officeResults" class="mt-3">

                <div class="pbmit-element-posts-wrapper pt-4">
                    <div class="row">
                    @foreach($schemeProgms as $schemeProgm)
                   
                    @foreach($schemeProgm->articleval_sub as $articleval_sub)
                        <div class="col-lg-3 mb-4">
                            <article class="pbmit-testimonial-style-4 swiper-slide">
                                <div class="pbminfotech-post-item">
                                    <!-- <img src="images/new.png" class="position-absolute newx" alt=""> -->
                                    <div class="pbmit-box-content-wrap">
                                        <div class="pbminfotech-box-desc">
                                            <img src="{{ asset('/assets/backend/uploads/articles/' . $articleval_sub->file) }}" class="w-100 img-fluid" alt="">
                                        </div>
                                        <div class="pbminfotech-box-author mb-3">
                                            <div class="pbmit-auther-content">
                                                <h3 class="pbminfotech-box-title">{{$articleval_sub->title}}</h3>
                                                <div class="pbminfotech-testimonial-detail">Created Date : {{ \Carbon\Carbon::parse($articleval_sub->created_at)->format('d.m.Y gA') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="opinion">
                                            <a href="{{ route('main.schemedetailpage', ['id' => Crypt::encryptString($schemeProgm->id)]) }}">Read More </a>
                                        </div>
                                    </div>

                                </div>
                            </article>
                        </div>
                        @endforeach
                        @endforeach
                    </div>
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
<script>
    $(document).ready(function() {
        $('.depId').change(function() {
            var selectedDepId = $(this).attr('value'); // Get the selected radio button ID

            $.ajax({
                url: '{{ route("main.SchemesdepartSel") }}',
                type: 'GET',
                data: {
                    depId: selectedDepId,
                    _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token
                },
                success: function(response) {
                    console.log('Success:', response);
                    // Handle the response (e.g., update UI)
                    $('.pbmit-element-posts-wrapper .row').html(response.html); // assuming `response.html` has the article cards

                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });

    // $(document).ready(function() {
    //     $('.depId').change(function() {
    //         var selectedDepId = $(this).attr('id'); // Get selected radio button ID
    //         var sessionbil = 1; // Set session language ID dynamically

    //         $.ajax({
    //             url: '{{ route("main.SchemesdepartSel") }}',
    //             type: 'GET',
    //             data: {
    //                 value: selectedDepId,
    //                 sessionbil: sessionbil,
    //                 _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
    //             },
    //             success: function(response) {
    //                 console.log(response);

    //                 // Append data in the div
    //                 $('#yourTargetDiv').html('');
    //                 $.each(response.data, function(index, office) {
    //                     $('#yourTargetDiv').append(`<p>${office.name}</p>`); // Modify as needed
    //                 });
    //             },
    //             error: function(xhr, status, error) {
    //                 console.error('Error:', error);
    //             }
    //         });
    //     });
    // });
</script>
@endsection