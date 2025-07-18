@extends('backend.layouts.htmlheader')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!! $breadcrumbarr !!}
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- <div><a class="btn btn-primary btn-sm" id="addarticle">Add BOD</a></div> -->
            @if (Session::get('success') != '')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if (session('delete'))
            <div class="alert alert-warning" role="alert">
                {{ session('delete') }}
                <strong>Success!</strong> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card">

                <div class="card-header text-white card-header-main">{{ __('Create of Board of directors') }}</div>
                <div class="card-body">

                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif

                    <input type="hidden" name="Errval" id="Errval" value="{{ $errors->any() ? '1' : '2' }}">
                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">

                        {!! implode(' ', $errors->all('<span class="text-danger">:message</span>')) !!}
                    </div> <!-- ./alert -->
                    @endif
                    @if (isset($editF))
                    <form id="formid" method="POST" action="{{ route('siteadmin.updateBOD') }}"
                        enctype="multipart/form-data">
                        @else
                        <form id="formid" method="POST" action="{{ route('siteadmin.storeBOD') }}"
                            enctype="multipart/form-data">
                            @endif

                            @csrf
                            <input type="hidden" name="hidden_id" value="{{ $keydata->id ?? '' }}">
                            <div class="col-sm-12">
                                <label for="designation" class="">Designation<span class="redalert"> *</span></label>
                                <select class="form-control select2" name="designation" id="designation" required>
                                    <option value="">Select</option>
                                    @foreach ($designations as $designation)
                                    @foreach ($designation->des_sub as $des_sub)
                                    <option value="{{$designation->id}}" @if(isset($editF)) {{ $designation->id == $keydata->desigId ? 'selected' : '' }} @endif>{{$des_sub->title}}</option>
                                    @endforeach
                                    @endforeach
                                </select>
                                <span class="ErrP alert-danger menuerr redalert" style="display: none;">Please Check the downloadtype Entered</span>
                                <span class="redalert">@error('gallerytype'){{$message}} @enderror</span>
                            </div>
        
                <div class="row card-header card-main">
                    @php
                    $i = 0;
                    @endphp
                    <div class="row mb-3 pt-3">

                        @foreach ($language as $langs)
                        <input type="hidden" value="{{ $langs->id ?? '' }}" id="sel_lang{{ $langs->id }}"
                            name="sel_lang[]">

                        <div class="col-sm-12">
                            <div class="row card-header card-custom-header bg-secondary text-white mb-3 mt-2">
                                <div class="col-sm-6 mb-btm">
                                    <label for="path"
                                        class="col-sm-2 col-form-label">{{ $langs->name }}</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 mb-btm" id="div{{ $langs->id }}">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Name in
                                        {{ $langs->name }} <span class="redalert"> *</span></label>
                                    <input id="name{{ $langs->id }}" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name[]"
                                        value="{{ $keydata->name ?? old('name.' . $i) }}" required
                                        autocomplete="name" placeholder="Enter name {{ $langs->name }} here"
                                        autofocus>
                                </div><br />
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-btm" id="div_description{{ $langs->id }}">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">message in
                                        {{ $langs->name }} <span class="redalert"> *</span></label>
                                    <textarea id="description{{ $langs->id }}" class="form-control ckeditor @error('description') is-invalid @enderror"
                                        name="description[]" value="{{ $keydata->title ?? old('description.' . $i) }}" required autocomplete="language"
                                        placeholder="Enter description in {{ $langs->name }} here" autofocus></textarea>
                                </div><br />
                            </div>

                            <!-- <div class="col-sm-6 mb-btm">
                                <div class="col-sm-6 mb-btm" id="div{{ $langs->id }}">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Alt in
                                        {{ $langs->name }} <span class="redalert"> *</span></label>
                                    <input id="alt{{ $langs->id }}" type="text"
                                        class="form-control @error('alt') is-invalid @enderror" name="alt[]"
                                        value="{{ $keydata->alt ?? old('alt.' . $i) }}" required autocomplete="alt"
                                        placeholder="Enter alt {{ $langs->name }} here" autofocus>
                                </div><br />
                            </div> -->


                        </div>

                        @php
                        $i++;
                        @endphp
                        @endforeach
                        <!-- <div class="row card-header card-custom-header bg-secondary text-white mb-3 mt-2">
                            <div class="col-sm-6 mb-btm">
                                <label for="path" class="col-sm-2 col-form-label">Common</label>
                            </div>
                        </div> -->
                        <div class="row div_lan1 mb-3 mt-2">
                            <div class="col-sm-6 mb-btm">
                                <div class="form-group">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Mobile Number <span
                                            class="redalert"> *</span></label>
                                    <input id="mobilenumber" type="text"
                                        class="form-control @error('mobilenumber') is-invalid @enderror"
                                        name="mobilenumber"
                                        value="{{ $keydata->mobilenumber ?? old('mobilenumber') }}" required
                                        autocomplete="mobilenumber" placeholder="Enter Mobile number here" autofocus>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-btm">
                                <div class="form-group">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Office Number <span
                                            class="redalert"> *</span></label>
                                    <input id="officenumber" type="text"
                                        class="form-control @error('officenumber') is-invalid @enderror"
                                        name="officenumber"
                                        value="{{ $keydata->officenumber ?? old('officenumber') }}" required
                                        autocomplete="officenumber" placeholder="Enter Office Number here" autofocus>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-btm">
                                <div class="form-group">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Email <span
                                            class="redalert"> *</span></label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $keydata->email ?? old('email') }}" required autocomplete="email"
                                        placeholder="Enter Email here" autofocus>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-btm">
                                <div class="form-group">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Photo <span
                                            class="redalert"> *</span></label>
                                    <input id="photo" type="file"
                                        class="form-control @error('photo') is-invalid @enderror" name="photo"
                                        value="{{ $keydata->photo ?? old('photo') }}" required autocomplete="photo"
                                        placeholder="Enter Photo here" autofocus>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-btm">
                                <div class="form-group form-check">
                                    <label for="exampleFormControlSelect2"></label>
                                    <br>
                                    <input type="checkbox" class="form-check-input" name="desig_flag"
                                        id="desig_flag" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Home page</label>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-btm">
                                <div class="form-group form-check">
                                    <label for="exampleFormControlSelect2"></label>
                                    <br>
                                    <input type="checkbox" class="form-check-input" name="chief_officers"
                                        id="chief_officers" value="1">
                                    <label class="form-check-label" for="exampleCheck1">Chief officers</label>
                                </div>
                            </div>
                            <br />
                        </div>


                        <div class="row mb-1">
                            <div class="col-sm-10 offset-sm-2">
                                @if ($editF ?? '')
                                <button type="submit" class="btn btn-warning">Update</button>
                                @else
                                <button type="submit" class="btn btn-primary">Add </button>
                                @endif
                            </div>
                        </div>
                    </div><!-- .row -->
                    </form>
                </div><!-- .card-body -->
            </div><!-- .card -->
            </div>
        </div><!-- .col-12 -->
    </div><!-- .row -->
</div><!-- .container -->
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {
        $(".selecttag").select2({
            width: '100%',
            tags: true,
        });
        $('#searchInput').on('keyup', function() {
            let query = $(this).val(); 
        });
        // if ($('#Errval').val() != 1) {
        //     $("#entry_div").hide();

        // }
        // if ($('#EditF').val() == 'E') {
        //     $("#entry_div").show();
        //     $("#datatable_div").hide();


        // } else {
        //     if ($('#Errval').val() != 1 && $('#EditF').val() != 'E') {
        //         $("#entry_div").hide();
        //     }
        // }
        // validation in LAng.
        $('#language').on('keyup', function(e) {
            var testres = engtitle('#language', this.value);
            if (!testres) {
                $('.titleerr').text("Not Allowed ");

                $('.titleerr').show();

            } else {
                $('.titleerr').hide();
            }
        });
        // $('#addarticle').on('click', function(e) {
        //     if ($('#entry_div').css('display') == 'none') {
        //         $('#entry_div').show();
        //     } else {
        //         $('#entry_div').hide();
        //     }


        // });
        // validation in class icon
        $('#icon_class').on('keyup', function(e) {
            var testres = iconclasscheck('#icon_class', this.value);
            if (!testres) {
                $('.iconerr').text("Not Allowed ");

                $('.iconerr').show();

            } else {
                $('.iconerr').hide();
            }
        });


        //append lang
        /* $(".radioval").click(function () {

          var val=$(this).attr('value');
          var check =  $(this).prop('checked');

          if(check)
          {

              if($(this).attr('value') != '') {
                  $('.div_lan1').show();
                  $('.div_lan2').show();
                  $('#div'+val).show();
                  $('#div_alt'+val).show()
                  $('#div_poster'+val).show();
                  $('#div_sub'+val).show();
                  $('#div_content'+val).show();
             }

             else {

                  $('#div'+val).hide();
                  $('#div_poster'+val).hide();
                  $('#div_sub'+val).hide();
                  $('#div_content'+val).hide();
                  $('#div_alt'+val).hide();
             }

          }else{

               $('#div'+val).hide();
               $('#div_sub'+val).hide();
               $('#div_poster'+val).hide();
               $('.div_lan1').hide();
               $('.div_lan2').hide();
               $('#div_alt').hide()
               $('#div_content').hide()
               $("#sel_lang"+val).prop('checked', false);
          }


         });*/
        $(".alert").fadeTo(2000, 2000).slideUp(2000, function() {
            $(".alert").slideUp(2000);
        });

        $('.alert').alert();
    });
</script>
@endsection