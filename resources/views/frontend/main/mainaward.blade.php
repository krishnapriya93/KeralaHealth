 <!-- -------------AWARDS AND RECOGNSTION------------------------------------------- -->
<section class="section-md pbmit-service-style-6-hover">
            <div class="service-twelve">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <article class="pbmit-service-style-6 swiper-slide">
                                <div class="pbminfotech-post-item">
                                    <div class="pbminfotech-box-content">
                                        <div class="pbmit-box-content-wrap">
                                            <div class="pbmit-service-image-wrapper">
                                                <div class="pbmit-featured-img-wrapper">
                                                    <div class="pbmit-featured-wrapper">
                                                        <img src="{{asset('assets/frontend/images/awa2.svg')}}" class="img-fluid" alt="service-img-01">
                                                    </div>
                                                </div>
                                                <a class="pbmit-service-btn" href="{{ route('main.whatsnewmain') }}" title="">
                                                    <span class="pbmit-button-icon-wrapper">
                                                        <span class="pbmit-button-icon">
                                                            <i class="pbmit-base-icon-black-arrow-1"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="pbmit-box-content-inner">
                                                <ul class="news-alerts newsticker">

                                                    @foreach ($mainawards as $mainaward)
                                                        @foreach ($mainaward->awardsub as $awardsub)
                                                        @php $FormatTitle = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $awardsub->title)) @endphp
                                                         <li><a href="{{ route('main.awarddetails', ['title' => $FormatTitle,'id' => Crypt::encryptString($mainaward->id) ]) }}">{{ $awardsub->title}}<p>Dated&nbsp;:&nbsp;{{ \Carbon\Carbon::parse($mainaward->date)->format('d F Y') }}</p> </a></li>
                                                        @endforeach
                                                    @endforeach
                                                    <!-- <li><a href="#">Kamala Harris's campaign lacks detail - but that's only helped her transform the race <p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">Manslaughter investigation begins over Sicily yacht wreck but no suspect identified <p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">sinking of a luxury yacht off Sicily. You can watch the conference at the top of this page <p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">Let's bring you some more lines from the press conference <p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">He adds it could be a case of manslaughter, but "we can only establish that if you give us time to investigate". <p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">hfgsdg ety jgdfgr <p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">Timeline for autopsies unclear at this stage <p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li> -->
                                                </ul>
                                            </div>
                                            <!-- <div class="r-m"><a href="#">View All</a></div> -->
                                        </div>

                                        <a class="pbmit-service-btn" href="/{{ route('main.whatsnewmain') }}" title="">
                                            <span class="pbmit-button-icon-wrapper">
                                                <span class="pbmit-button-icon">
                                                    <i class="pbmit-base-icon-black-arrow-1"></i>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                    <a class="pbmit-link" href="{{ route('main.whatsnewmain') }}"></a>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-4 mb-3">
                            <article class="pbmit-service-style-6 swiper-slide">
                                <div class="pbminfotech-post-item">
                                    <div class="pbminfotech-box-content">
                                        <div class="pbmit-box-content-wrap">
                                            <div class="pbmit-service-image-wrapper">
                                                <div class="pbmit-featured-img-wrapper">
                                                    <div class="pbmit-featured-wrapper">
                                                        <img src="{{asset('assets/frontend/images/sdd1.svg')}}" class="img-fluid" alt="service-img-01">
                                                    </div>
                                                </div>
                                                <a class="pbmit-service-btn" href="{{ route('main.sdg') }}" title="Annual Check-ups">
                                                    <span class="pbmit-button-icon-wrapper">
                                                        <span class="pbmit-button-icon">
                                                            <i class="pbmit-base-icon-black-arrow-1"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="pbmit-box-content-inner">
                                                <ul class="news-alerts newsticker">
                                                    @foreach($sustainables as $sustainable)
                                                        @foreach($sustainable->articleval_sub as $articleval_sub)
                                                        @php $FormatTitle = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $articleval_sub->title)) @endphp
                                                        <li><a href="{{ route('main.articledetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($sustainable->id) ]) }}">{{$articleval_sub->title ?? ''}}<p>Dated&nbsp;:&nbsp;{{ \Carbon\Carbon::parse($sustainable->s_date)->format('d F Y') }}</p> </a></li>
                                                        @endforeach
                                                    @endforeach
                                                    <!-- <li><a href="#">2. Maternal and Child Health<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">3. Communicable Diseases Control<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">4. Non-Communicable Diseases (NCDs)<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">5. Reproductive and Sexual Health<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">6. Mental Health and Well-being<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">7. Health Promotion and Disease Prevention<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">8. Access to Medicines and Vaccines<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">SDG 6: Clean Water and Sanitation (Health-Related)<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">SDG 2: Zero Hunger and Nutrition (Health-Related)<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">SDG 5: Gender Equality (Health-Related)<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">SDG 13: Climate Action (Health-Related)<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                        <a class="pbmit-service-btn" href="#" title="Annual Check-ups">
                                            <span class="pbmit-button-icon-wrapper">
                                                <span class="pbmit-button-icon">
                                                    <i class="pbmit-base-icon-black-arrow-1"></i>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                    <a class="pbmit-link" href="{{ route('main.sdg') }}"></a>
                                </div>
                            </article>
                        </div>
                        <div class="col-md-4 mb-3">
                            <article class="pbmit-service-style-6 swiper-slide">
                                <div class="pbminfotech-post-item">
                                    <div class="pbminfotech-box-content">
                                        <div class="pbmit-box-content-wrap">
                                            <div class="pbmit-service-image-wrapper">
                                                <div class="pbmit-featured-img-wrapper">
                                                    <div class="pbmit-featured-wrapper">
                                                        <img src="{{asset('assets/frontend/images/alert1.svg')}}" class="img-fluid" alt="service-img-01">
                                                    </div>
                                                </div>
                                                <a class="pbmit-service-btn" href="#" title="Annual Check-ups">
                                                    <span class="pbmit-button-icon-wrapper">
                                                        <span class="pbmit-button-icon">
                                                            <i class="pbmit-base-icon-black-arrow-1"></i>
                                                        </span>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="pbmit-box-content-inner">
                                                <ul class="news-alerts newsticker">
                                                @foreach ($mainEmergInfos as $mainEmergInfo)
                                                        @foreach ($mainEmergInfo->announcesub as $announcesub)
                                                         <li><a href="#">{{ $announcesub->title}}<p>Dated&nbsp;:&nbsp;{{ \Carbon\Carbon::parse($mainEmergInfo->s_date)->format('d F Y') }}</p> </a></li>
                                                        @endforeach
                                                    @endforeach

                                                    <!-- <li><a href="#">1. Universal Health Coveragess<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li> -->
                                                    <!-- <li><a href="#">2. Maternal and Child Health<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">3. Communicable Diseases Control<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">4. Non-Communicable Diseases (NCDs)<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">5. Reproductive and Sexual Health<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">6. Mental Health and Well-being<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">7. Health Promotion and Disease Prevention<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">8. Access to Medicines and Vaccines<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">SDG 6: Clean Water and Sanitation (Health-Related)<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">SDG 2: Zero Hunger and Nutrition (Health-Related)<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">SDG 5: Gender Equality (Health-Related)<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li>
                                                    <li><a href="#">SDG 13: Climate Action (Health-Related)<p>Dated&nbsp;:&nbsp;21/21/2021</p> </a></li> -->
                                                </ul>
                                            </div>
                                        </div>
                                        <a class="pbmit-service-btn" href="#" title="Annual Check-ups">
                                            <span class="pbmit-button-icon-wrapper">
                                                <span class="pbmit-button-icon">
                                                    <i class="pbmit-base-icon-black-arrow-1"></i>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                    <a class="pbmit-link" href="{{ route('main.whatsnewmain') }}"></a>
                                </div>
                            </article>
                        </div>
                    </div>
                </div>
                <!-- <center class="mt-4">
                      <a class="pbmit-btn" href="#">
                          <span class="pbmit-button-content-wrapper">
                              <span class="pbmit-button-icon pbmit-align-icon-right">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="22.76" height="22.76" viewBox="0 0 22.76 22.76">
                                      <title>black-arrow</title>
                                      <path d="M22.34,1A14.67,14.67,0,0,1,12,5.3,14.6,14.6,0,0,1,6.08,4.06,14.68,14.68,0,0,1,1.59,1" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                      <path d="M22.34,1a14.67,14.67,0,0,0,0,20.75" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                      <path d="M22.34,1,1,22.34" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                  </svg>
                              </span>
                              <span class="pbmit-button-text">See More</span>
                          </span>
                      </a>
                  </center> -->
                <!-- <div class="shape-img-01">
                      <img src="images/homepage-12/shap-01.png" alt="">
                  </div>
                  <div class="shape-img-02">
                      <img src="images/homepage-12/shap-02.png" alt="">
                  </div> -->
            </div>
        </section>
