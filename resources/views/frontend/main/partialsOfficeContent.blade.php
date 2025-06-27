<div class="pbmit-column-inner">

    <div class="swiper-slider" id="office-content" data-autoplay="true" data-loop="true" data-dots="false" data-arrows="false" data-columns="2" data-margin="30" data-effect="slide">

    <div class="swiper-wrapper">
   
    @foreach ($officelists as $office)
            @if (!empty($office->logo)) 
            @foreach ($office->office_sub as $office_sub)
@php
    if(!empty($maindepartment->id)) 
        $maindepartment = $maindepartment->id;
    else
        $maindepartment = $maindepartment;
  
@endphp
            <div class="swiper-slide mb-4 mt-1">
                <article class="pbmit-client-style-1" id="client-article">
                    <div class="pbmit-border-wrapper">
                        <div class="pbmit-client-wrapper pbmit-client-with-hover-img">
                            <div class="pbmit-client-hover-img">
                             
                                <a href="{{ route('main.department-details', ['title' => $FormatTitle,'id' => Crypt::encryptString($office->id)]) }}"> {{ $office_sub->title }}</a>
                            </div>
                            <div class="pbmit-featured-img-wrapper">
                                <div class="pbmit-featured-wrapper">

                                    <a href="#" style="display: flex; align-items: center;">
                                        <img src="{{ asset('/assets/backend/uploads/Officelogo/' . $office->logo) }}" class="img-fluid" alt="" style="width: 70px; height: 70px; margin-right: 10px;">
                                        <span>{{ $office_sub->title }}</span>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            @endforeach
            @endif
            @endforeach
</div>

    </div>
    <div class="view-all w-x mt-3">
        <a href="{{ route('main.departmentlist') }}"> {{  App\Http\Controllers\FrontendController::getSiteControlLabel('viewall') ?? 'View All' }}</a>
    </div>
</div>