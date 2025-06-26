<!-- ------------wellness tips------------------------------------------------------------->

<section class="pbmit-element-service-style-7 section-md" style="position: relative;">
            <img src="{{asset('assets/frontend/images/well2.png')}}" alt="" class="left-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="pbmit-heading-subheading animation-style2">
                            <h4 class="pbmit-subtitle">  {{  App\Http\Controllers\FrontendController::getSiteControlLabel('healthinfo') ?? 'Health Info' }}</h4>
                            <h2 class="{{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1' }}">  {{  App\Http\Controllers\FrontendController::getSiteControlLabel('wellnesstips') ?? 'Wellness Tips' }}</h2>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
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
                                <span class="pbmit-button-text"> {{  App\Http\Controllers\FrontendController::getSiteControlLabel('viewall') ?? 'View All' }}</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row">
                   
                    @foreach ($wellnessTips as $wellnessTip)
                  
                    <article class="pbmit-service-style-7 col-md-12 pbmit-active">
                        <div class="pbminfotech-post-item">
                            <div class="pbminfotech-box-content">
                                <div class="pbmit-box-content-wrap">
                                    <div class="pbmit-box-content-inner">
                                 
                                        @foreach ($wellnessTip->wellnessTipTypesub as $wellnessTipType)
                                       @php 
                                       $encryptedData = Crypt::encryptString(1);
                                       @endphp
                                        @if(isset($sessionbil) && $sessionbil == 2)
                                            @php $FormatTitle = preg_replace('/[^\p{Malayalam}A-Za-z0-9_]/u', '', str_replace(' ', '_', $wellnessTipType->title));  @endphp
                                        @else
                                            @php $FormatTitle = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $wellnessTipType->title)) @endphp
                                        @endif
                            
                                            <div class="pbmit-service-icon elementor-icon">
                                                <img src="{{asset('/assets/backend/uploads/WellnessIcon/'.$wellnessTip->iconimg)}}" alt="">
                                            </div>
                                            <div class="pbmit-title-box">
                                                <h3 class="pbmit-service-title">
                                                    <a href="#">{{$wellnessTipType->title ?? ''}}</a>
                                                </h3>
                                            </div>

                                        
                                        <div class="pbmit-desc-box">
                                            <div class="pbmit-service-description">
                                         
                                            {!! $wellnessTipType->description !!}
                                            
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="pbmit-service-btn" href="#" title="Dental Care">
                                    <span class="pbmit-button-icon-wrapper">
                                        <span class="pbmit-button-icon">
                                            <i class="pbmit-base-icon-black-arrow-1"></i>
                                        </span>
                                    </span>
                                </a>
                            </div>
                            <div class="pbmit-service-image-wrapper">
                                <div class="pbmit-featured-img-wrapper">
                                    <div class="pbmit-featured-wrapper">
                                        <img src="{{asset('/assets/backend/uploads/WellnessBgImage/'.$wellnessTip->backgroundimg)}}" class="img-fluid" alt="service-img-01">
                                    </div>
                                </div>
                               
                                <h3 class="pbmit-service-title">
                                    <a href="{{ route('wellnessdetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($wellnessTip->id),'data' => $encryptedData]) }}">{{$wellnessTipType->title}}</a>
                                </h3>
                            </div>
                          
                            <a class="pbmit-link" href="{{ route('wellnessdetail', ['title' => $FormatTitle,'id' => Crypt::encryptString($wellnessTip->id),'data' => $encryptedData]) }}"></a>
                        </div>
                    </article>
                    @endforeach
                </div>
                <div class="row d-none">
                    <div class="col d-flex justify-content-center mt-3 pt-3">
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
                                <span class="pbmit-button-text"> {{  App\Http\Controllers\FrontendController::getSiteControlLabel('viewall') ?? 'View All' }}</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </section>