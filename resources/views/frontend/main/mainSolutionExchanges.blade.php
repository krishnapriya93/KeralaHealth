<!-------------------------- Solution Exchange Pla-tform --------------------------->
<section class="section-xl discount-plan-area">
            <div class="container">
                <div class="discount-plan-bg pbmit-bg-color-white">
                    <div class="row w-100">
                        <div class="col-md-6">
                            <div class="doctor-img">
                                <img src="{{asset('assets/frontend/images/Componen0.png')}}" class="img-fluid" alt="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="content-area">
                                <div class="pbmit-heading-subheading animation-style2">
                                    <h4 class="pbmit-subtitle">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('submitsuggestion') ?? 'Submit Suggestion' }}</h4>
                                    <h2 class="pbmit-title1 {{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1 text-white' }}">  {{  App\Http\Controllers\FrontendController::getSiteControlLabel('solutionexchange') ?? 'Solution Exchange Platform' }}</h2>
                                    <div class="pbmit-heading-desc mt-4 mb-4">
                                    {{$mainprojects->sitelcontrollabel_sub[0]->alternatetext ?? ''}}
                                    </div>
                                </div>
                                <a class="pbmit-btn" href="{{ route('main.publiclogin') }}">
                                    <span class="pbmit-button-content-wrapper">
                                        <span class="pbmit-button-icon pbmit-align-icon-right">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="22.76" height="22.76" viewBox="0 0 22.76 22.76">
                                                <title>black-arrow</title>
                                                <path d="M22.34,1A14.67,14.67,0,0,1,12,5.3,14.6,14.6,0,0,1,6.08,4.06,14.68,14.68,0,0,1,1.59,1" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                                <path d="M22.34,1a14.67,14.67,0,0,0,0,20.75" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                                <path d="M22.34,1,1,22.34" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                            </svg>
                                        </span>
                                        <span class="pbmit-button-text">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('signsubmit') ?? 'Sign in to Submit' }}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>