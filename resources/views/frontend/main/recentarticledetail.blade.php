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
                                {{ $articleTypeName }}
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
              
       
                <div class="pbmit-element-posts-wrapper pt-0">
                    <div class="row">
                    @foreach($recentarticles as $recentarticle)
                 
                    @foreach($recentarticle->articleval_sub as $articleval_sub)
                                        @php 
                                            $FormatTitle   = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $articleval_sub->title));
                                            $articleTypeId = $recentarticle->articletype_id;
                                        @endphp
                        <div class="col-lg-3 mb-4">
                            <article class="pbmit-testimonial-style-4 swiper-slide">
                                <div class="pbminfotech-post-item">
                                    <!-- <img src="images/new.png" class="position-absolute newx" alt=""> -->
                                    <div class="pbmit-box-content-wrap">
                                        <div class="pbminfotech-box-desc">
                                           @if(isset($articleval_sub->file) && !empty($articleval_sub->file))
                                               <img src="{{ asset('/assets/backend/uploads/articles/' . $articleval_sub->file) }}" class="w-100 img-fluid" alt="">

                                            @else
                                                <img src="{{ asset('assets/frontend/images/Subtract2.png') }}" class="w-100 img-fluid" alt="">

                                           @endif
                                        </div>
                                        <div class="pbminfotech-box-author mb-3">
                                            <div class="pbmit-auther-content">
                                                <h3 class="pbminfotech-box-title">{{$articleval_sub->title}}</h3>
                                                <div class="pbminfotech-testimonial-detail">Created Date : {{ \Carbon\Carbon::parse($articleval_sub->created_at)->format('d.m.Y gA') }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="opinion">
                                            <a href="{{ route('main.articledetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($recentarticle->id) ]) }}">Read More </a>
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
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });

    $(document).ready(function() {
        $('.depId').change(function() {
            var selectedDepId = $(this).attr('id'); // Get selected radio button ID
            var sessionbil = 1; // Set session language ID dynamically

            $.ajax({
                url: '{{ route("main.SchemesdepartSel") }}',
                type: 'GET',
                data: {
                    value: selectedDepId,
                    sessionbil: sessionbil,
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    console.log(response);

                    // Append data in the div
                    $('#yourTargetDiv').html('');
                    $.each(response.data, function(index, office) {
                        $('#yourTargetDiv').append(`<p>${office.name}</p>`); // Modify as needed
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });
    });
</script>
@endsection