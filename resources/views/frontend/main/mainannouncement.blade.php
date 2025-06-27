  <!-- -------------ANNOUNCEMENT DASHBOARD------------------------------------------- -->

  <section class="section-md product-ad-section announce ">
      <div class="container-fluid px0">
          <div class="row">
              <div class="col-md-6 p-0 col-xl-6">
                  <div class="product-ad-left-box position-relative">
                      <div class="row mt-5">
                          <div class="col-md-12 pb-4">
                              <div class="pbmit-heading-subheading text-white animation-style2">
                                  <h4 class="pbmit-subtitle">
                                  {{  App\Http\Controllers\FrontendController::getSiteControlLabel('newannouncements') ?? 'New Announcements' }}
                                  </h4>
                                  <div class="d-sm-flex justify-content-between align-items-center">
                                  <h3 class="animation-style2 {{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1 text-white' }}">
                                  {{  App\Http\Controllers\FrontendController::getSiteControlLabel('announcements') ?? 'Announcements' }}
                                  </h3>

                                      <!-- <h3 class="pbmit-title animation-style2">
                                      {{  App\Http\Controllers\FrontendController::getSiteControlLabel('announcements') ?? 'Announcements' }}
            
                                      </h3> -->
                                      <div class="view-all">
                                          <a href="{{ route('main.announcement') }}">View All</a>
                                      </div>
                                  </div>
                              </div>
                              <div class="swiper-slider" data-autoplay="true" data-loop="true" data-dots="true" data-arrows="false" data-columns="2" data-margin="30" data-effect="slide">
                                  <div class="swiper-wrapper">
                                      <!-- Slide1 -->

                                      @foreach ($mainannouncements as $mainannouncement)
                                      @foreach ($mainannouncement->announcesub as $announcesub)
                                      <div class="swiper-slide">
                                          <article class="pbmit-testimonial-style-2">
                                              <img src="{{asset('/assets/frontend/images/loudspeaker.png')}}" class="speaker" alt="">
                                              <div class="pbminfotech-post-item">
                                                  <div class="pbmit-box-content-wrap">
                                                      <div class="pbminfotech-box-star-ratings">
                                                          <i class="pbmit-base-icon-calendar-3 pbmit-active"></i><span>{{ \Carbon\Carbon::parse($mainannouncement->s_date)->format('F d, Y') }}
                                                          </span>
                                                      </div>
                                                      <div class="pbminfotech-box-desc">
                                                          <blockquote class="pbminfotech-testimonial-text">
                                                              <p>{!! $announcesub->title !!}</p>
                                                          </blockquote>
                                                      </div>
                                                      <div class="pbminfotech-box-author d-flex align-items-center">
                                                          <div class="pbmit-auther-content ms-0">
                                                              <a href="{{ route('main.announcementitem',\Crypt::encryptString($mainannouncement->id)) }}">
                                                                  <div class="pbminfotech-testimonial-detail">Read More</div>
                                                              </a>
                                                          </div>
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
                  </div>
              </div>
              <div class="col-md-6 p-0 col-xl-6">
                  <div class="product-ad-right-box position-relative">
                      <div class="row mt-5">
                          <div class="col-md-12 pb-4">

                              <div class="pbmit-heading-subheading text-white">
                                  <h4 class="pbmit-subtitle">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('portal_dashboard') ?? 'Health Portal Dashboard' }}</h4>
                                  <div class="d-sm-flex align-items-center justify-content-between animation-style1">
                                  <h3 class="animation-style2 {{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1 text-white' }}">
                                  {{  App\Http\Controllers\FrontendController::getSiteControlLabel('dashboard') ?? 'Dashboard' }}
                                  </h3>

                                      <!-- <h3 class="pbmit-title animation-style2">
                                      {{  App\Http\Controllers\FrontendController::getSiteControlLabel('dashboard') ?? 'Dashboard' }}
                                          
                                      </h3> -->
                                      <div class="view-all">
                                          <a href="{{ route('dashboard') }}">View All</a>
                                      </div>
                                  </div>

                              </div>
                              <p class="tele-p">
                              {{  App\Http\Controllers\FrontendController::getSiteControlLabel('dashboard_content') ?? 'dashboard_content' }}
                                  <!-- Lorem Ipsum is simply dummy text of the printing and typesetting industrs standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled -->
                              </p>
                              <div class="fid-section_one">
                                  <div class="row">
                                      <div class="col-md-6 col-xl-3">
                                          <div class="pbminfotech-ele-fid-style-5">
                                              <div class="pbmit-fld-contents">
                                                  <div class="pbmit-fld-wrap">
                                                      <div class="pbmit-icon-wrap">
                                                          <div class="pbmit-sbox-icon-wrapper">
                                                              <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                                  <i class="pbmit-xcare-icon pbmit-xcare-icon-team"></i>
                                                              </div>
                                                          </div>
                                                          <h3 class="pbmit-fid-title">Our Doctors </h3>
                                                      </div>
                                                      <h4 class="pbmit-fid-inner">
                                                          <span class="pbmit-fid-before"></span>
                                                          <span class="pbmit-number-rotate numinate">235</span>
                                                          <!-- <span class="pbmit-fid"><sup>+</sup></span> -->
                                                      </h4>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6 col-xl-3">
                                          <div class="pbminfotech-ele-fid-style-5">
                                              <div class="pbmit-fld-contents">
                                                  <div class="pbmit-fld-wrap">
                                                      <div class="pbmit-icon-wrap">
                                                          <div class="pbmit-sbox-icon-wrapper">
                                                              <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                                  <i class="pbmit-xcare-icon pbmit-xcare-icon-surgery-room"></i>
                                                              </div>
                                                          </div>
                                                          <h3 class="pbmit-fid-title">Medical Beds</h3>
                                                      </div>
                                                      <h4 class="pbmit-fid-inner">
                                                          <span class="pbmit-fid-before"></span>
                                                          <span class="pbmit-number-rotate numinate">420</span>

                                                      </h4>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6 col-xl-3">
                                          <div class="pbminfotech-ele-fid-style-5">
                                              <div class="pbmit-fld-contents">
                                                  <div class="pbmit-fld-wrap">
                                                      <div class="pbmit-icon-wrap">
                                                          <div class="pbmit-sbox-icon-wrapper">
                                                              <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                                  <i class="pbmit-xcare-icon pbmit-xcare-icon-gesundheit"></i>
                                                              </div>
                                                          </div>
                                                          <h3 class="pbmit-fid-title">Happy Patients</h3>
                                                      </div>
                                                      <h4 class="pbmit-fid-inner">
                                                          <span class="pbmit-fid-before"></span>
                                                          <span class="pbmit-number-rotate numinate">30</span>
                                                          <span class="pbmit-fid">
                                                              <span>&nbsp;K</span>
                                                          </span>
                                                      </h4>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-md-6 col-xl-3">
                                          <div class="pbminfotech-ele-fid-style-5">
                                              <div class="pbmit-fld-contents">
                                                  <div class="pbmit-fld-wrap">
                                                      <div class="pbmit-icon-wrap">
                                                          <div class="pbmit-sbox-icon-wrapper">
                                                              <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                                  <i class="pbmit-xcare-icon pbmit-xcare-icon-gesundheit-1"></i>
                                                              </div>
                                                          </div>
                                                          <h3 class="pbmit-fid-title">Winning Awards</h3>
                                                      </div>
                                                      <h4 class="pbmit-fid-inner">
                                                          <span class="pbmit-fid-before"></span>
                                                          <span class="pbmit-number-rotate numinate">305</span>

                                                      </h4>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <!-- <div class="col-12 bg-white tele-m">
                                          <div class="row d-flex">
                                               <div class="col"><a href="#"><img src="images/m2.jpg" alt=""></a> </div>
                                              <div class="col"> <a href="#"><img src="images/m1.jpg" alt=""> </a> </div>
                                              <div class="col"><a href="#"><img src="images/m3.jpg" alt="" > </a></div>
                                          </div>
                                      </div> -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>