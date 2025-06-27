 <!------------------ departments Start ------------------------------------------------>
 <section class="section-md our-health-care-section">

     <div class="container-fluid p-0">
         <div class="row">
             <div class="col-md-12 col-xl-6">
                 <div class="right-content">
                 <div class="pbmit-heading-subheading animation-style2">
                    <h2 class="{{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1' }} mb-4 text-light text-center">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('department') ?? 'Departments' }}</h2>
                    <br>
                    <div class="pbmit-tab">
                             <ul class="nav nav-tabs" role="tablist">
                                 @php
                                 $isFirst = true; // Variable to track the first iteration across all items
                                 @endphp
                 
                                 @foreach ($maindepartments as $maindepartment)

                                 @foreach ($maindepartment->depcat_sub as $index => $depcat_sub)
                                 @php $FormatTitle = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $depcat_sub->title)) @endphp
                                 <li class="nav-item" role="presentation">
                                     <a value="{{$maindepartment->id}}" rel="{{$maindepartment->department}}" data-title="{{ $FormatTitle }}" class="nav-link depcatSel {{ $isFirst ? 'active' : '' }}" data-bs-toggle="tab" href="#tab-2-{{ $index }}" aria-selected="{{ $isFirst ? 'true' : 'false' }}" role="tab">
                                         <span class="" value="{{$maindepartment->id}}" >{{ $depcat_sub->title }}</span>
                                     </a>
                                 </li>
                                 @php
                                 $isFirst = false; // Set to false after the first item
                                 @endphp
                                 @endforeach
                                 @endforeach

                             </ul>
                             <div class="tab-content" id="office-content">
                                 <div class="tab-pane show active" id="tab-2-1" role="tabpanel">

                                     @include('frontend.main.partialsOfficeContent', ['officelists' => $officelists,'maindepartment'=>$maindepartment,'FormatTitle'=>$FormatTitle])

                                 </div>


                             </div>
                         </div> 
                </div>
                 </div>
             </div>
             <div class="col-md-12 col-xl-6">
                 <div class="right-content">
                     <div class="pbmit-heading-subheading animation-style2">
                         <!-- <h2 class="pbmit-title mb-4 text-light text-center ">Organizations</h2> -->
                         <h2 class="{{ isset($sessionbil) && $sessionbil == 1 ? 'pbmit-title' : 'pbmit-title1' }} mb-4 text-light text-center">{{  App\Http\Controllers\FrontendController::getSiteControlLabel('organization') ?? 'Organizations' }}</h2>

                         <br>
                         <div class="pbmit-tab">
                             <ul class="nav nav-tabs" role="tablist">
                                 @php
                                 $isFirst = true; // Variable to track the first iteration across all items
                                 @endphp
                                 @foreach ($mainorganizations as $mainorganization)
                                 @foreach ($mainorganization->depcat_sub as $index => $depcat_sub)
                                 @php $FormatTitle = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $depcat_sub->title)) @endphp
                                 <li class="nav-item" role="presentation">
                                    <a value="{{$maindepartment->id}}" rel="{{$maindepartment->department}}" data-title="{{ $FormatTitle }}" class="nav-link OrgcatSel {{ $isFirst ? 'active' : '' }}" data-bs-toggle="tab" href="#tab-2-{{ $index }}" aria-selected="{{ $isFirst ? 'true' : 'false' }}" role="tab">
                                         <span class="" value="{{$maindepartment->id}}" >{{ $depcat_sub->title }}</span>
                                    </a>

                                 </li>
                                 @php
                                 $isFirst = false; // Set to false after the first item
                                 @endphp
                                 @endforeach
                                 @endforeach
                                 <!-- <li class="nav-item" role="presentation">
                                     <a class="nav-link active" data-bs-toggle="tab" href="#tab-2-11" aria-selected="true" role="tab">
                                         <span>Health Department</span>
                                     </a>
                                 </li>
                                 <li class="nav-item" role="presentation">
                                     <a class="nav-link" data-bs-toggle="tab" href="#tab-2-22" aria-selected="false" role="tab" tabindex="-1">
                                         <span>Ayush Department</span>
                                     </a>
                                 </li> -->
                             </ul>
                      
                             <div class="tab-content" id="office-content2">
                                 <div class="tab-pane show active" id="tab-2-11" role="tabpanel">
                                    
                                     @include('frontend.main.partialsOfficeContentOrg', ['orgnazationlists' => $orgnazationlists,'mainorganization'=>$mainorganization,'FormatTitle'=>$FormatTitle,'mainid' => $mainorganization->departmentfieldid])
                                 </div>

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script>
     $(document).ready(function() {

         $('.depcatSel').click(function(event) {
             event.preventDefault(); // Prevents the default link behavior
             var value = $(this).attr('value'); // Get the 'value' attribute - catgry
             var text = $(this).text(); // Get the text inside the span
             var department = $(this).attr('rel');//dpart
             var title = $(this).data('title'); // Fetch 'data-title' attribute
// alert('CAT: ' + value + ', department: ' + department);
             //  alert('Value: ' + value + ', Text: ' + text);
             //  $('#client-article').empty();
             $.ajax({
                 url: '{{ route('officeSeldepCat') }}', // Replace with your server endpoint
                 method: 'POST',
                 data: {
                     value: value,
                     text: text,
                     department:department,
                     title:title,
                     _token: '{{ csrf_token() }}' // CSRF token for Laravel
                 },
                 success: function(response) {
                     // Clear the existing content
                     console.log(response);
                     $('#office-content').html(response);
                     // Reinitialize Swiper
                     new Swiper('#office-content', {
                         autoplay: true,
                         loop: true,
                         slidesPerView: 2,
                         spaceBetween: 30,
                         effect: 'slide',
                         pagination: {
                             el: '.swiper-pagination',
                             clickable: true
                         },
                         navigation: {
                             nextEl: '.swiper-button-next',
                             prevEl: '.swiper-button-prev'
                         }
                     });

                 },
                 error: function(xhr, status, error) {
                     // Handle any errors
                     console.error('Error:', error);
                 }
             });
         });
     });
     $('.OrgcatSel').click(function(event) {
             event.preventDefault(); // Prevents the default link behavior
             var value = $(this).attr('value'); // Get the 'value' attribute - catgry
             var text = $(this).text(); // Get the text inside the span
             var department = $(this).attr('rel');//dpart
             var title = $(this).data('title'); // Fetch 'data-title' attribute
// alert('CAT: ' + value + ', department: ' + department);
             //  alert('Value: ' + value + ', Text: ' + text);
             //  $('#client-article').empty();
             $.ajax({
                 url: '{{ route('officeSelorgCat') }}', // Replace with your server endpoint
                 method: 'POST',
                 data: {
                     value: value,
                     text: text,
                     department:department,
                     title:title,
                     _token: '{{ csrf_token() }}' // CSRF token for Laravel
                 },
                 success: function(response) {
                     // Clear the existing content
                     console.log(response);
                     $('#office-content2').html(response);
                     // Reinitialize Swiper
                     new Swiper('#office-content2', {
                         autoplay: true,
                         loop: true,
                         slidesPerView: 2,
                         spaceBetween: 30,
                         effect: 'slide',
                         pagination: {
                             el: '.swiper-pagination',
                             clickable: true
                         },
                         navigation: {
                             nextEl: '.swiper-button-next',
                             prevEl: '.swiper-button-prev'
                         }
                     });

                 },
                 error: function(xhr, status, error) {
                     // Handle any errors
                     console.error('Error:', error);
                 }
             });
         });

 </script>
 <!-- <script>
    $(document).ready(function () {
        $('.depcatSel').on('click', function (e) {
            e.preventDefault();
            var departmentId = $(this).data('department');
            var categoryId = $(this).data('category');
            var targetTab = $(this).attr('href');
alert(categoryId);
            $('.tab-pane').removeClass('show active');
            $(targetTab).addClass('show active');

            // Fetch updated office content via AJAX
            $.ajax({
                url: "{{ route('officeSeldepCat') }}",
                type: "POST",
                data: { department_id: departmentId, category_id: categoryId ,
                    _token: '{{ csrf_token() }}' // CSRF token for Laravel
                },
                success: function (response) {
                    $(targetTab).html(response);
                }
            });
        });
    });
</script> -->