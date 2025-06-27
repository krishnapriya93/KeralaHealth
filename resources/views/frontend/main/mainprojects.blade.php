  <!----------------------------- Projects ---------------------------------->
  <section class="pbmit-sticky-section section-md overview position-relative pb-4" style="overflow: hidden!important;">
      <img src="{{asset('assets/frontend/images/logo-big.svg')}}" alt="" class="left-3">
      <div class="container">
          <div class="row">

              <div class="col-md-12 col-lg-5 pbmit-sticky-col">
                  <div class="pbmit-ele-header-area header-style-2 ">
                      <div class="pbmit-heading-subheading pt-40 animation-style1">
                          <h4 class="pbmit-subtitle">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('healthscape') ?? 'Healthscape' }}</h4>
                          <h2 class="wyt {{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1 text-white' }}"> 
                            @foreach($mainhealthscapes->articleval_sub as $articleval_sub)
                                    {{$articleval_sub->title ?? ''}}
                            @endforeach</h2>
                          <div class="pbmit-heading-desc darki">
                            @foreach($mainhealthscapes->articleval_sub as $articleval_sub)
                            {!! \Illuminate\Support\Str::limit($articleval_sub->content, 200) !!}
                            @php $FormatTitle = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $articleval_sub->title)) @endphp

                            @endforeach
                             
                          </div>
                      </div>
                      <div class="pbmit-button-box-second">

                          <a class="pbmit-btn" href="{{ route('main.healthscapedetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($mainhealthscapes->id)]) }}">
                              <span class="pbmit-button-content-wrapper">
                                  <span class="pbmit-button-icon pbmit-align-icon-right">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="22.76" height="22.76" viewBox="0 0 22.76 22.76">
                                          <title>black-arrow</title>
                                          <path d="M22.34,1A14.67,14.67,0,0,1,12,5.3,14.6,14.6,0,0,1,6.08,4.06,14.68,14.68,0,0,1,1.59,1" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                          <path d="M22.34,1a14.67,14.67,0,0,0,0,20.75" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                          <path d="M22.34,1,1,22.34" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                      </svg>
                                  </span>
                                  <span class="pbmit-button-text">View More</span>
                              </span>
                          </a>
                      </div>
                  </div>
              </div>

              <div class="col-md-12 col-lg-7 pbmit-servicebox-right">
                  @foreach($mainarticles as $mainarticle)

                  @foreach($mainarticle->articleval_sub as $articleval_sub)
                  @php $FormatTitle = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $articleval_sub->title)) @endphp
                  <article class="pbmit-service-style-4">
                      <div class="pbminfotech-post-item">
                          <div class="pbminfotech-box-content">
                              <div class="pbmit-box-content-wrap">
                                  <div class="pbmit-featured-img-wrapper">
                                      <div class="pbmit-featured-wrapper">
                                          <img src="{{asset('/assets/backend/uploads/articles/'.$articleval_sub->file)}}" class="img-fluid" alt="">
                                      </div>
                                  </div>
                                  <div class="pbmit-box-content-inner">
                                      <img src="{{asset('assets/frontend/images/logo-big.svg')}}" alt="" class="ser-log">
                                      <div class="pbmit-content-inner-wrap">
                                          <div class="pbmit-contant-box">
                                              
                                                <div class="pbmit-serv-cat ">
                                                    <a href="{{ route('main.articledetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($mainarticle->id) ]) }}" rel="tag">{{$mainarticle->articletypeval->articletype_sub[0]->title}}</a>
                                                </div>
  
                                              
                                              <h3 class="pbmit-service-titlex">
                                                  <a href="{{ route('main.articledetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($mainarticle->id)]) }}">
                                                      {{$articleval_sub->title}}
                                                  </a>
                                              </h3>
                                          </div>
                                      </div>
                                      <div class="pbmit-service-description">
                                          {!! \Illuminate\Support\Str::limit($articleval_sub->content, 100) !!}

                                      </div>
                                  </div>
                              </div>
                              <a class="pbmit-service-btn" href="{{ route('main.articledetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($mainarticle->id)]) }}" title="Keraal health article image">
                                  <span class="pbmit-button-icon-wrapper">
                                      <span class="pbmit-button-icon">
                                          <i class="pbmit-base-icon-black-arrow-1"></i>
                                      </span>
                                  </span>
                              </a>
                          </div>
                          <a class="pbmit-link" href="{{ route('main.articledetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($mainarticle->id)]) }}"></a>
                      </div>
                  </article>
                  @endforeach
                  @endforeach

              </div>
          </div>
      </div>
  </section>
  