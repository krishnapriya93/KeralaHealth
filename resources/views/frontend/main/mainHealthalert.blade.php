<!-- ----------------Health  Alerts-------------------------------- -->
<section class="section-md">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xl-5">
                <div class="why-choose-us-four-heading">
                    <div class="pbmit-heading-subheading animation-style2">
                        <h4 class="pbmit-subtitle">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('healthalerts') ?? 'Health Alerts' }}</h4>
                           <h2 class="pbmit-title1 {{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1 text-white' }}">{{$healthAlertSitecntl->sitelcontrollabel_sub[0]->title}} 
                        </h2>
                        <div class="pbmit-heading-desc">
                        {{$healthAlertSitecntl->sitelcontrollabel_sub[0]->alternatetext}} 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-xl-7">
                <div class="why-choose-us-four-rightbox">
                    <div class="row">
                        @foreach($healthAlerts as $healthAlert)
                        @foreach($healthAlert->announcesub as $announcesub)
                        <div class="col-md-6">
                            <div class="pbmit-ihbox-style-24">
                                <div class="pbmit-ihbox-box d-flex">
                                    <div class="pbmit-ihbox-icon">
                                        <div class="pbmit-ihbox-icon-wrapper pbmit-icon-type-icon">
                                            @php
                                            $healthAlerticon=$healthAlert->icon;
                                            @endphp
                                            <i class="pbmit-xcare-icon {{$healthAlerticon}}"></i>
                                        </div>
                                    </div>
                                    @if($healthAlert->id == 18)
                                    <a href="{{ route('main.ambulancedetails') }}">
                                    @else
                                    <a href="#">
                                    @endif
                                    
                                        <div class="pbmit-ihbox-contents">
                                            <h2 class="pbmit-element-title">{{$announcesub->title}}</h2>
                                            <div class="pbmit-heading-desc">{!!$announcesub->description!!}</div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>