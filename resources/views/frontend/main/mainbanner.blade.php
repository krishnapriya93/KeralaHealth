<div class="pbmit-slider-area pbmit-slider-one">
    <div class="swiper-slider" data-autoplay="true" data-loop="true" data-dots="true" data-arrows="false" data-columns="1" data-margin="0" data-effect="fade">
        <div class="swiper-wrapper">
          
            @foreach($mainbanners as $mainbanner)

            @foreach($mainbanner->banner_sub as $banner_sub)
            <div class="swiper-slide">
                <div class="pbmit-slider-item">
                    <div class="pbmit-slider-bg" style="background-image: url( {{asset('assets/backend/uploads/banner/'.$banner_sub->poster) }})"></div>

                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <div class="pbmit-slider-content">
                                    @if($mainbanner->text_view_flag ==1)
                                    <h5 class="pbmit-sub-title transform-top transform-delay-1">Tradition. Quality. Progress.</h5>
                                    <h2 class="pbmit-title transform-bottom transform-delay-2">Driving Innovation <br> <strong>To Wellness</strong> </h2>
                                    <div class="pbmit-button transform-bottom transform-delay-3">
                                        <a class="pbmit-btn pbmit-btn-outline" href="#">
                                            <span class="pbmit-button-content-wrapper">
                                                <span class="pbmit-button-icon pbmit-align-icon-right">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="22.76" height="22.76" viewBox="0 0 22.76 22.76">
                                                        <title>black-arrow</title>
                                                        <path d="M22.34,1A14.67,14.67,0,0,1,12,5.3,14.6,14.6,0,0,1,6.08,4.06,14.68,14.68,0,0,1,1.59,1" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                                        <path d="M22.34,1a14.67,14.67,0,0,0,0,20.75" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                                        <path d="M22.34,1,1,22.34" transform="translate(-0.29 -0.29)" fill="none" stroke="#000" stroke-width="2"></path>
                                                    </svg>
                                                </span>
                                                <span class="pbmit-button-text">read more</span>
                                            </span>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            @endforeach

            <!-- Slide3
            <div class="swiper-slide">
                <div class="pbmit-slider-item">
                    <div class="pbmit-slider-bg" style="background-image: url({{asset('assets/frontend/images/slider-img/slide2.jpg')}});"></div>
                    <div class="container">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <div class="pbmit-slider-content">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
</div>