<!-- ---------------------MINISTERS-------------------------------------------------->
<section class="section-lg   pb-3">
    <div class="container">
        <div class="row">
            @foreach ($bods as $bod)
                @foreach ($bod->bodsub as $bodsub)
                <div class="col-md-6 col-xl-4">
                <div class="pbmit-ihbox-style-32">
                    <div class="pbmit-ihbox-box">
                        <div class="pbmit-ihbox-box-number">
                            <img src="{{asset('assets/frontend/images/left.png')}}" class="img-fluid" alt="">
                        </div>
                        <div class="pbminfotech-box-author d-flex align-items-center">
                            <div class="pbminfotech-box-img">
                                <div class="pbmit-featured-img-wrapper">
                                    <div class="pbmit-featured-wrapper ">
                                        <img src="{{asset('/assets/backend/uploads/bod/'.$bod->photo)}}" class="" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="pbmit-auther-content">
                                <h3 class="pbminfotech-box-title">{{$bodsub->name}} </h3>
                                <div class="pbminfotech-testimonial-detail">
                                @foreach ($bod->designation as $designation)
                                    @foreach ($designation->des_sub as $des_sub)
                                    {{$des_sub->title}}
                                    @endforeach
                                @endforeach
                               </div>
                            </div>
                        </div>
                        <div class="pbmit-content-box d-flex justify-content-between">
                            <div class="pbmit-content-wrapper">
                                <div class="pbmit-heading-desc">
                                {!! \Illuminate\Support\Str::limit($bodsub->description, 200) !!}

                                </div>
                            </div>

                            <div class="pbmit-ihbox-icon position-absolute quote">
                                <div class="pbmit-ihbox-icon-wrapper pbmit-icon-type-icon">
                                    <img src="{{asset('assets/frontend/images/quote.png')}}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="{{ route('main.dobmessage-detail',\Crypt::encryptString($bod->id)) }}" class="moree">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
                @endforeach
            @endforeach
            
            
            <div class="col-md-12 col-xl-4 mt-xl-0 mt-4 d-none">
                <div class="pbmit-ihbox-style-32">
                    <div class="pbmit-ihbox-box text-center" style="    padding: 33px 47px;">
                        <div class="pbmit-ihbox-box-number">
                            <img src="{{asset('assets/frontend/images/circle.png')}}" class="img-fluid" alt="" width="24">
                        </div>
                        <img src="{{asset('assets/frontend/images/sdgs-circle.png')}} " class="sdg-img1 img-fluid" alt="">
                        <img src="{{asset('assets/frontend/images/sdgv.png')}} " class="mb-4 img-fluid" alt="">
                        <a href="#" class="sdg-m">Know More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>