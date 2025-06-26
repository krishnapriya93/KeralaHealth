@extends('backend.layouts.htmlheader')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!!$breadcrumbarr!!}
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white card-header-main">{{isset($edit_f) ? 'Update' : 'Add'}} Award</div>

                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">

                        {!! implode(' ', $errors->all('<li><span class="text-danger">:message</span></li>')) !!}
                    </div> <!-- ./alert -->
                    @endif
                    @if(isset($edit_f))
                    <form id="formiid" method="POST" action="{{ route('siteadmin.updateAward') }}" enctype="multipart/form-data">
                        @else
                        <form id="formiid" method="POST" action="{{ route('siteadmin.storeAward') }}" enctype="multipart/form-data">
                            @endif

                            @csrf
                            <input type="hidden" name="hidden_id" value="{{$keydata->id ?? ''}}">
                            <input type="hidden" name="edit_id" value="{{$edit_f ?? ''}}">
                            <div class="row mb-3">
                                @php
                                $i=0;
                                @endphp
                                <!-- EDiting Start -->
                        
                                @if(isset($edit_f))
                                @if(isset($keydata->id)) @foreach(($keydata->awardsub) as $awardsub)
                             
                                <input type="hidden" value="{{$awardsub->languageid ?? ''}}" id="sel_lang{{$awardsub->languageid}}" name="sel_lang[]">
                                <div class="col-sm-12 mb-btm" id="div{{$awardsub->id}}">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Wellness type in {{$awardsub->lang_sel->name}} <span class="redalert"> *</span></label>
                                    <input id="title{{$awardsub->id}}" type="text" class="form-control title_validation @error('title') is-invalid @enderror" name="title[]" value="{{ $awardsub->title ?? old('title.'.$i)}}" rel="{{$awardsub->id}}" required autocomplete="title" placeholder="Enter {{$awardsub->name}} here" autofocus>
                                    <span class="ErrP redalert titleerr1" style="display: none;">Please Check the {{$awardsub->title}} title Entered</span>
                                    <span class="ErrP redalert titleerr2" style="display: none;">Please Check the {{$awardsub->title}} title Entered</span>
                                </div>
                                <div class="row div_lan1 mb-3">
                                    <div class="col-sm-12 mb-btm" id="div{{$awardsub->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Award Description in {{$awardsub->lang_sel->name}} <span class="redalert"> *</span></label>
                                        <textarea id="description{{$awardsub->id}}" type="text" class="form-control ckeditor @error('description') is-invalid @enderror" name="description[]" value="{{ $keydata->title ?? old('alt_title')}}" required autocomplete="description" placeholder="Enter description {{$awardsub->name}} here" autofocus >{{$awardsub->description}}</textarea>                                        
                                        <span class="ErrP redalert titleerr1 display_status">Please Check the {{$awardsub->name}} title Entered</span>
                                        <span class="ErrP redalert titleerr2 display_status">Please Check the {{$awardsub->name}} title Entered</span>
                                    </div><br />
                                </div>
                                @endforeach @endif

                                <!-- EDiting End -->
                                @else
                                @foreach($language as $langs)

                                <input type="hidden" value="{{$langs->id ?? ''}}" id="sel_lang{{$langs->id}}" name="sel_lang[]">

                                <div class="col-sm-12 mb-btm mb-3" id="div{{$langs->id}}">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Award name in {{$langs->name}} <span class="redalert"> *</span></label>
                                    <input id="title{{$langs->id}}" type="text" class="form-control title_validation @error('title') is-invalid @enderror" name="title[]" value="{{ $keydata->title ?? old('title.'.$i)}}" rel="{{$langs->id}}" required autocomplete="title" placeholder="Enter {{$langs->name}} here" autofocus>
                                    <span class="ErrP redalert titleerr1" style="display: none;">Please Check the {{$langs->title}} title Entered</span>
                                    <span class="ErrP redalert titleerr2" style="display: none;">Please Check the {{$langs->title}} title Entered</span>
                                </div>

                                <div class="row div_lan1 mb-3">
                                    <div class="col-sm-12 mb-btm" id="div{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Award Description in {{$langs->name}} <span class="redalert"> *</span></label>
                                        <textarea id="description{{$langs->id}}" type="text" class="form-control ckeditor @error('description') is-invalid @enderror" name="description[]" value="{{ $keydata->title ?? old('alt_title')}}" required autocomplete="description" placeholder="Enter description {{$langs->name}} here" autofocus >{{$langs->description}}</textarea>                                        
                                        <span class="ErrP redalert titleerr1 display_status">Please Check the {{$langs->name}} title Entered</span>
                                        <span class="ErrP redalert titleerr2 display_status">Please Check the {{$langs->name}} title Entered</span>
                                    </div><br />
                                </div>

                                @php
                                $i++;
                                @endphp
                                @endforeach
                                @endif
                            </div><br>

                            <div class="row mb-3">
                                <!-- <div class="col-sm-6 mb-btm" id="div_icon">
                                    <div class="col-sm-6"> <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Award Upload </label>
                                        <input type="file" id="imageUpload" accept="image/*" name="imageUpload" class="form-control" value="{{$keydata->iconimg ?? ''}}">
                                        <img id="imagePreview" src="" alt="Image Preview" style="display:none; width: 200px; height: 200px;">
                                        @if(isset($edit_f))  @if(isset($keydata->iconimg))
                                            <div class="form-group">
                                                <label for="imageUploadprev">Poster Preview:</label><br>
                                                <img src="{{ asset('/assets/backend/uploads/WellnessIcon/'.$keydata->iconimg) }}" alt="Poster" width="100" height="150">
                                            </div>
                                        @endif
                                        @endif
                                    </div>
                                </div> -->
                                <div class="col-sm-6 mb-btm" id="div_date">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Date<span class="redalert"> *</span></label>
                                    @if(isset($edit_f))  @if(isset($keydata->date))
                                     @php
                                      $formateddate=\Carbon\Carbon::parse($keydata->date)->format('Y-m-d');
                                    @endphp
                                    @endif
                                    @endif
                                
                                    <input id="date" type="date" class="form-control title_validation @error('title') is-invalid @enderror" name="date" value="{{ $formateddate  ?? date('Y-m-d') }}" rel="" required autocomplete="date" placeholder="Enter date here" autofocus>
                                    <span class="ErrP redalert dateerr" style="display: none;">Please Check the date Entered</span>
                                    <span class="ErrP redalert dateerr" style="display: none;">Please Check the date title Entered</span>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-10 offset-sm-2">
                                    @if($edit_f ?? '')
                                    <button type="submit" class="btn btn-warning">Update & Upload Images</button>
                                    @else
                                    <button type="submit" class="btn btn-primary">Add & Upload Images </button>
                                    @endif
                                </div>
                            </div>
                        </form>


                </div>
            </div>
            <br>


        </div>
    </div>
</div>
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {


        ///tittle validation
        $('.title_validation').on('keyup', function(e) {

            if ($(this).attr('rel') == 1) {
                var testres = engtitle('.title_validation', this.value);

                if (!testres) {
                    // alert($(this).parent().find( ".titleerr1" ).html());
                    $(this).find(".titleerr1").text("Not Allowed / only english ");
                    // $('.titleerr1').text("Not Allowed1 ");
                    //  $('.titleerr2').hide();
                    $(this).parent().find(".titleerr1").show();
                    $('.submitBtn').prop('disabled', true);
                    // $('.titleerr1').sh
                } else {
                    $('.titleerr1').hide();
                    $('.titleerr2').hide();
                    $('.submitBtn').prop('disabled', false);
                }


            } else if ($(this).attr('rel') == 2) {
                var testres = maltitle('.title', this.value);

                if (!testres) {

                    $(this).find(".titleerr2").text("Not Allowed/ only malayalam ");
                    //    $('.titleerr1').hide();
                    $('.submitBtn').prop('disabled', true);
                } else {

                    $('.titleerr2').hide();
                    $('.titleerr1').hide();
                    $('.submitBtn').prop('disabled', false);
                }

            }

        });
        $('#imageUpload').change(function() {
        var input = this;
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result);
                $('#imagePreview').show();  // Show the image preview
            }
            
            reader.readAsDataURL(input.files[0]);  // Convert the file to base64 string
        } else {
            $('#imagePreview').hide();  // Hide preview if no file is selected
        }
    });
    $('#imageUpload').change(function() {
        var input = this;
        
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#imagePreview1').attr('src', e.target.result);
                $('#imagePreview1').show();  // Show the image preview
            }
            
            reader.readAsDataURL(input.files[0]);  // Convert the file to base64 string
        } else {
            $('#imagePreview1').hide();  // Hide preview if no file is selected
        }
    });

    });
</script>
@endsection