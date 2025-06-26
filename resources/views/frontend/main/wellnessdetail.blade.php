@extends('frontend.layouts.main_header')
<style>
    .custom-list ul {
        list-style-type: none; 
        padding: 0;
    }
    .custom-list li {
        position: relative;
        padding-left: 25px;
        margin-bottom: 10px;
    }
    .custom-list li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 3px;
        display: inline-block;
        width: 15px;
        height: 15px;
        background-size: contain;
        background-repeat: no-repeat;
        background-image: url('{{ asset('assets/frontend/images/p1.png') }}'); /* Inline Blade */
    }
    li::marker {
            content: none;
        }


</style>
@section('content')

<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->
    
          <!-- Title Bar -->
          <div class="pbmit-title-bar-wrapper wellness_bg">
              <div class="container">
                  <div class="pbmit-title-bar-content">
                      <div class="pbmit-title-bar-content-inner">
                          <div class="pbmit-tbar">
                              <div class="pbmit-tbar-inner container">
                                  <h1 class="pbmit-tbar-title"> Wellness Tips </h1>
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
                              <div class="post blog-classic">    
                                  <div class="welln pbmit-heading animation-style1" style="background-image:url('{{ asset('/assets/backend/uploads/WellnessBgImage/' . $wellnessTips->wellnessTipType[0]->backgroundimg) }}')">
                                    <h4>{{$wellnessTips->wellnessTipsub[0]->title}}</h4>
                                  </div>
                                  <hr />
                                  <div class="pbmit-blog-classic-inner">
                                      <div class="pbmit-entry-content">
                                      <!-- <p class="custom-list pbmit-firstletter">
                                        
                                            {!! htmlspecialchars_decode($wellnessTips->wellnessTipsub[0]->description) !!}
                                        </p> -->
                                        <ul class="custom-list pbmit-firstletter" style="text-align: justify;">
                                            {!! str_replace('<li>', '<li style="background-image: url(' . asset('assets/frontend/images/p1.png') . '); padding-left: 25px; background-repeat: no-repeat; background-size: 15px 15px; background-position: left center; display: block; min-height: 20px;">', htmlspecialchars_decode($wellnessTips->wellnessTipsub[0]->description)) !!}
                                        </ul>


                                          <!-- <p>If you run an internet search for medical blogs, you’ll come acrnd figuring out which sources arein the field can learn from Whether you’re,considering medical school well-informed decisions about your own health, there’s something on this list for everyone. Keep this list of medical blogs handy and the answers to your medical away.</p> -->
                                          <div class="project-single-img_box">
                                              <!-- <div class="row mb-3">
                                                  <div class="col-md-6 mx-auto">
                                                      <a class="popup-youtube" href="http://www.youtube.com/watch?v=0O2aH4XLbto">
                                                          <img src="{{ asset('/assets/frontend/images/wellnews1.jpg') }}" alt="">
                                                      </a>
                                                  </div>
                                              </div> -->
                                              <!-- <video class="w-100" autopla controls muted loop>
                                                  <source src="images/bgh.mp4" type="video/mp4">
                                                  Your browser does not support the video tag.
                                              </video>                                                         -->
                                          </div>
                                          <!-- <ul class="list-group list-group-borderless">
                                              <li class="list-group-item">
                                                  <span class="pbmit-icon-list-icon">
                                                      <i aria-hidden="true" class="ti-check"></i>
                                                  </span>
                                                  <span class="pbmit-icon-list-text">Starchy foods are a key food group in healthy eating guidelines</span>
                                              </li>
                                              <li class="list-group-item">
                                                  <span class="pbmit-icon-list-icon">
                                                      <i aria-hidden="true" class="ti-check"></i>
                                                  </span>
                                                  <span class="pbmit-icon-list-text">However, people are sleeping much less than they did in the past</span>
                                              </li>
                                              <li class="list-group-item">
                                                  <span class="pbmit-icon-list-icon">
                                                      <i aria-hidden="true" class="ti-check"></i>
                                                  </span>
                                                  <span class="pbmit-icon-list-text">Don’t smoke or use drugs, and only drink in moderation</span>
                                              </li>
                                              <li class="list-group-item">
                                                  <span class="pbmit-icon-list-icon">
                                                      <i aria-hidden="true" class="ti-check"></i>
                                                  </span>
                                                  <span class="pbmit-icon-list-text">Clean eating is a term that took over the wellness world a couple of back</span>
                                              </li>
                                              <li class="list-group-item">
                                                  <span class="pbmit-icon-list-icon">
                                                      <i aria-hidden="true" class="ti-check"></i>
                                                  </span>
                                                  <span class="pbmit-icon-list-text">Your body is full of trillions of bacteria, viruses and fungi</span>
                                              </li>
                                          </ul> -->
                                      </div>
                                  </div>   
                              </div> 
                              
                              <!-- <nav class="navigation post-navigation" aria-label="Posts">
                                  <div class="nav-links">
                                      <div class="nav-previous">
                                          <a href="blog-details.html" rel="prev">
                                              <span class="pbmit-post-nav-icon">
                                                  <i class="pbmit-base-icon-left-arrow-1"></i>
                                                  <span class="pbmit-post-nav-head">Previous</span>
                                              </span>
                                              <span class="pbmit-post-nav-wrapper">
                                                  <span class="pbmit-post-nav nav-title">ppppppppp</span> 
                                              </span>
                                          </a>
                                      </div>
                                      <div class="nav-next">
                                          <a href="#" rel="next">
                                              <span class="pbmit-post-nav-icon">
                                                  <span class="pbmit-post-nav-head">Next</span>
                                                  <i class="pbmit-base-icon-next"></i>
                                              </span>
                                              <span class="pbmit-post-nav-wrapper">
                                                  <span class="pbmit-post-nav nav-title">oooooooooooo</span> 
                                              </span>
                                          </a>
                                      </div>
                                  </div>
                              </nav> -->
                          </article>
              </div>
                      <div class="col-md-12 col-lg-3 blog-left-col">
                          <aside class="sidebar">
                              <aside class="widget widget-recent-post">
                                  <h2 class="widget-title">Related Tips</h2>
                                      <ul class="recent-post-list wells">
                                        @foreach($RelatwellnessTips as $RelatwellnessTip)
                                     @php $encryptedId = Crypt::encryptString($RelatwellnessTip->id);
                                     $encryptedData = Crypt::encryptString(2);
                                     @endphp
                        
                                        @foreach($RelatwellnessTip->wellnessTipsub as $wellnessTipsub)
                                        @if(isset($sessionbil) && $sessionbil == 2)
                                            @php $FormatTitle = preg_replace('/[^\p{Malayalam}A-Za-z0-9_]/u', '', str_replace(' ', '_', $wellnessTipsub->title));  @endphp
                                        @else
                                            @php 
                                            $FormatTitle = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $wellnessTipsub->title)) ;
                                            
                                            @endphp
                                        @endif
                                          <li class="recent-post-list-li"> 
                                          @foreach($RelatwellnessTip->wellnessTipType as $wellnessTipType)
                                              <a href="{{ route('wellnessdetail', ['title' => $FormatTitle,
                                                                                    'id'   => Crypt::encryptString($RelatwellnessTip->id),
                                                                                    'data' => $encryptedData
                                                                                    ]) }}" 
                                               style="background-image: url('{{ asset('/assets/backend/uploads/WellnessBgImage/' . $wellnessTipType->backgroundimg) }}');" class="w-100">
                                          @endforeach
                                              <p>  
                                                {!! strip_tags($wellnessTipsub->title, '<font-family><p class="pbmit-firstletter"><a><ul><li>') !!}
                                            </p>
                                              </a>
                                          </li>
                                          @endforeach
                                          @endforeach
                                          <!-- <li class="recent-post-list-li"> 
                                              <a href="#"  style="background-image: url('images/mental.jpg');" class="w-100">
                                               <p>Mental Health</p>
                                              </a>
                                          </li>
                                          <li class="recent-post-list-li"> 
                                              <a href="#"  style="background-image: url('images/thea.jpg');" class="w-100">
                                               <p>Excercise</p>
                                              </a>
                                          </li>
                                          <li class="recent-post-list-li"> 
                                              <a href="#"  style="background-image: url('images/excer.jpg');" class="w-100">
                                               <p>Therapi</p>
                                              </a>
                                          </li>
                                          <li class="recent-post-list-li"> 
                                              <a href="#"  style="background-image: url('images/life.jpg');" class="w-100">
                                               <p>Life Style</p>
                                              </a>
                                          </li> -->
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