@extends('frontend.layouts.main_header')
<style>
    .image-container {
    display: flex;
    justify-content: center;
}

</style>
@section('content')
    <!-- page wrapper -->
    <div class="page-wrapper pbmit-bg-color-light">
      
        <!-- Header Main Area -->
        @include('frontend.layouts.main_menu')
        <!-- Header Main Area End Here -->
        	<!-- Title Bar --> 
            <div class="pbmit-title-bar-wrapper article_bg">
                <div class="container">
                    <div class="pbmit-title-bar-content">
                        <div class="pbmit-title-bar-content-inner">
                            <div class="pbmit-tbar">
                                <div class="pbmit-tbar-inner container">
                                    <h1 class="pbmit-tbar-title"> Schemes and Programmes </h1>
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

            <section class="site_content blog-details">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-9 blog-right-col">
                                    <article class="main-article">
                                       
                                        <div class="post blog-classic">    
                                            <div class="pbmit-heading animation-style1">
                                                <h3 class="{{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1 text-white' }} mb-3">
                                                @foreach($articleDet->articleval_sub as $articleval_sub)
                                                        {{$articleval_sub->title ?? ''}}
                                                @endforeach
                                                </h3>
                                            </div>
                                            <div class="pbmit-blog-classic-inner">
                                                <div class="pbmit-blog-meta pbmit-blog-meta-top">	
                                                    <span class="pbmit-meta pbmit-meta-date">
                                                        <i class="pbmit-base-icon-calendar-3"></i>&nbsp;{{ \Carbon\Carbon::parse($articleDet->created_at)->format('F d, Y') }}

                                                    </span>
                                                    <span class="pbmit-meta pbmit-meta-author">
                                                        <i class="pbmit-base-icon-user-3"></i>
                                                        @foreach($articleDet->office as $office)
                                                              @foreach($office->office_sub as $office_sub)
                                                              {{ $office_sub->title ?? ''}}
                                                              @endforeach
                                                        @endforeach
                                                    </span>
                                                    <span class="pbmit-meta pbmit-meta-comments pbmit-comment-bigger-than-zero">
                                                        <i class="pbmit-base-icon-chat-3"></i>3 Comments
                                                    </span>			
                                                </div>
                                                <div class="pbmit-entry-content">
                                                @foreach($articleDet->articleval_sub as $articleval_sub)
                                                    <p class="pbmit-firstletter">
                                                    {!! strip_tags($articleval_sub->content, '<font><p class="pbmit-firstletter"><a><ul><li>') !!}
                                                    </p>
                                                @endforeach

                                                    <div class="project-single-img_box">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="pbmit-animation-style1">
                                                                @foreach($articleDet->articleval_sub as $articleval_sub)
                                                                @if(!empty($articleval_sub->file))
                                                                    <img src="{{ asset('/assets/backend/uploads/articles/' . $articleval_sub->file) }}" class="img-fluid image-container " alt="">
                                                                @endif
                                                                @endforeach
                                                              
                                                                </div>
                                                            </div>
                                                            <!-- <div class="col-md-6">
                                                                <div class="pbmit-animation-style1">
                                                                    <img src="images/child-care-about.jpg" class="img-fluid" alt="">
                                                                </div>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>   
                                        </div> 
                                        
                                    
                                    </article>
                        </div>
                        <div class="col-md-12 col-lg-3 blog-left-col">
                            <aside class="widget">
                                <div class="textwidget">
                                    <div class="download">
                                        <div class="item-download">
                                            <a href="#" target="_blank" rel="noopener noreferrer">
                                                <span class="pbmit-download-content">
                                                    <i class="pbmit-base-icon-pdf-file-format-symbol-1"></i> Download Pdf File 
                                                </span>
                                                <span class="pbmit-download-item">
                                                        <img src="{{ asset('assets/frontend/images/download.gif')}}" width="40" height="40" alt="">
                                                </span>
                                            </a>
                                        </div>
                                       
                                    </div>
                                </div>
                            </aside>

                            <aside class="sidebar">
                                <aside class="widget widget-recent-post">
                                    <h2 class="widget-title">Related News</h2>
                                    
                                        <ul class="recent-post-list">
                                        @foreach($Relatedarticles as $Relatedarticle)
                                        @foreach($Relatedarticle->articleval_sub as $articleval_sub)
                                            <li class="recent-post-list-li"> 
                                                <div class="pbmit-rpw-content">
                                                    <span class="pbmit-rpw-date">
                                                        <a href="">{{ \Carbon\Carbon::parse($articleval_sub->created_at)->format('d.m.Y gA') }}</a>
                                                    </span>
                                                    <span class="pbmit-rpw-title">
                                                        <a href="{{ route('main.schemedetailpage', ['id' => Crypt::encryptString($Relatedarticle->id)]) }}"> {{ $articleval_sub->title ?? ''}}</a>
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