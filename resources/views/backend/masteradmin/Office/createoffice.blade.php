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
                <div class="card-header text-white card-header-main">{{isset($edit_f) ? 'Update' : 'Add'}} Department category</div>

                <div class="card-body">
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">

                        {!! implode(' ', $errors->all('<li><span class="text-danger">:message</span></li>')) !!}
                    </div> <!-- ./alert -->
                    @endif
                    @if(isset($edit_f))
                    <form id="formiid" method="POST" action="{{ route('masteradmin.updateoffice') }}" enctype="multipart/form-data">
                        @else
                        <form id="formiid" method="POST" action="{{ route('masteradmin.storeoffice') }}" enctype="multipart/form-data">
                            @endif

                            @csrf
                            <input type="hidden" name="hidden_id" value="{{$keydata->id ?? ''}}">
                            <input type="hidden" name="edit_id" id="edit_id" value="{{$edit_f ?? ''}}">
                            <div class="row mb-3">
                                <label for="department" class="my-1 mr-2">Department<span class="redalert"> *</span></label>

                                <div class="card-body text-primary">
                                    @foreach ($department as $departments)
                                    <div class="form-check form-check-inline">

                                        @foreach ($departments->dep_sub as $dep_sub)
                                        <input class="form-check-input" type="radio" name="department" id="{{ $departments->id}}" value="{{ $departments->id}}" @if(isset($edit_f)){{ ($keydata->department == $departments->id)   ? 'checked' : '' }} @else checked @endif>

                                        <label class="form-check-label" for="inlineRadio1">
                                            {{$dep_sub->title}}
                                        </label>
                                        @endforeach

                                    </div>
                                    @endforeach

                                </div> <!--card end-->

                            </div> <!--row end-->
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <label for="gallerytype" class="my-1 mr-2">Department Field<span class="redalert"> *</span></label>
                                    <select class="form-control select2 formselect" name="depfield" id="depfield" required>
                                        <option value="">Select</option>

                                        @foreach ($depfield as $depfields)
                                        @foreach ($depfields->depfd_sub as $depfd_sub)
                                        <option value="{{$depfields->id}}" @if(isset($edit_f)) {{ $depfields->id == $keydata->depafields ? 'selected' : '' }} @endif>{{$depfd_sub->title}}</option>
                                        @endforeach
                                        @endforeach
                                    </select>
                                    <span class="ErrP alert-danger menuerr redalert" style="display: none;">Please Check the downloadtype Entered</span>
                                    <span class="redalert">@error('gallerytype'){{$message}} @enderror</span>
                                </div>
                                <div class="col-sm-6">
                                    <label for="gallerytype" class="my-1 mr-2">Department category<span class="redalert"> *</span></label>
                                    <select class="form-control select2 formselect" name="depcat" id="depcat" required>
                                        <option value="">Select</option>
                                        @if(isset($edit_f))
                                        @foreach ($departcats as $departcat)
                                        @foreach ($departcat->depcat_sub as $depcat_sub)
                                        <option value="{{$departcat->id}}" @if(isset($edit_f)) {{ $departcat->id == $keydata->depcat ? 'selected' : '' }} @endif>{{$depcat_sub->title}}</option>
                                        @endforeach
                                        @endforeach
                                        @endif

                                    </select>
                                    <span class="ErrP alert-danger menuerr redalert" style="display: none;">Please Check the downloadtype Entered</span>
                                    <span class="redalert">@error('gallerytype'){{$message}} @enderror</span>
                                </div>
                            </div>
                     
                            <div class="row mb-4">
    <div class="col-sm-6">
        <label for="dep_sub_select" class="form-label">
            Select Sub Menus <span class="redalert">*</span>
        </label>

        <select 
            class="form-control select2" 
            name="dep_sub_ids[]" 
            id="dep_sub_select" 
            multiple 
            required
        >
      
            @foreach($depsubmenus as $dept)
                @foreach($dept->dep_submenu as $sub)
                    <option 
                        value="{{ $dept->id }}"
                        @if(!empty($selectedDepSubs) && in_array($dept->id, $selectedDepSubs)) selected @endif
                    >
                        {{ $sub->title }}
                    </option>
                @endforeach
            @endforeach
        </select>

        <span class="ErrP alert-danger menuerr redalert" style="display: none;">
            Please select at least one sub-department
        </span>
    </div>
</div>


                            <div class="row mb-3">
                                @php
                                $i=0;
                                @endphp
                                <!-- EDiting Start -->
                                @if(isset($edit_f))
                                @if(isset($keydata->id)) @foreach(($keydata->office_sub) as $office_sub)

                                <input type="hidden" value="{{$office_sub->languageid ?? ''}}" id="sel_lang{{$office_sub->languageid}}" name="sel_lang[]">

                                <div class="col-sm-6 mb-btm" id="div{{$office_sub->id}}">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Office name in {{$office_sub->name}} <span class="redalert"> *</span></label>
                                    <input id="title{{$office_sub->id}}" type="text" class="form-control title_validation @error('title') is-invalid @enderror" name="title[]" value="{{ $office_sub->title ?? old('title.'.$i)}}" rel="{{$office_sub->id}}" required autocomplete="title" placeholder="Enter {{$office_sub->name}} here" autofocus>
                                    <span class="ErrP redalert titleerr1" style="display: none;">Please Check the {{$office_sub->title}} title Entered</span>
                                    <span class="ErrP redalert titleerr2" style="display: none;">Please Check the {{$office_sub->title}} title Entered</span>
                                </div>
                                @endforeach @endif

                                <!-- EDiting End -->
                                @else
                                @foreach($language as $langs)

                                <input type="hidden" value="{{$langs->id ?? ''}}" id="sel_lang{{$langs->id}}" name="sel_lang[]">
                                <div class="row mb-3">
                                    <div class="col-sm-12 mb-btm" id="div{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Office name in {{$langs->name}} <span class="redalert"> *</span></label>
                                        <input id="title{{$langs->id}}" type="text" class="form-control title_validation @error('title') is-invalid @enderror" name="title[]" value="{{ $keydata->title ?? old('title.'.$i)}}" rel="{{$langs->id}}" required autocomplete="title" placeholder="Enter {{$langs->name}} here" autofocus>
                                        <span class="ErrP redalert titleerr1" style="display: none;">Please Check the {{$langs->title}} title Entered</span>
                                        <span class="ErrP redalert titleerr2" style="display: none;">Please Check the {{$langs->title}} title Entered</span>
                                    </div>
                                </div>

                                @php
                                $i++;
                                @endphp
                                @endforeach
                                @endif
                            </div><br>

                            <div class="row mb-3">

                                <div class="col-sm-12mb-btm" id="div_logo">
                                    <div class="col-sm-6"> <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Logo </label>
                                        <input type="file" id="imageUpload" accept="image/*" name="imageUpload" class="form-control" value="{{ $keydata->logo ?? old('poster')}}">
                                        @if(isset($edit_f))<img id="imagePreviewedit" src="{{asset('/assets/backend/uploads/Officelogo/'.$keydata->logo)}}" alt="Image Preview" style="display:none; width: 200px; height: 200px;" value="{{ $keydata->logo ?? old('poster')}}"> @endif

                                        <img id="imagePreview" src="" alt="Image Preview" style="display:none; width: 200px; height: 200px;" value="{{ $keydata->logo ?? old('poster')}}">
                                    </div>


                                </div><br />
                            </div>

                            <div class="col-sm-6 mb-btm">
                                <div class="form-group form-check">
                                    <label for="office_view_flag"></label>
                                    <br>
                                    <input type="checkbox" class="form-check-input" name="office_view_flag"
                                        id="office_view_flag"
                                        value="1"
                                        {{ old('office_view_flag', $keydata->office_view_flag ?? 0) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="office_view_flag">Office Display Status</label>
                                </div>
                            </div>




                </div>

                <div class="row mb-3">
                    <div class="col-sm-10 offset-sm-2">
                        @if($edit_f ?? '')
                        <button type="submit" class="btn btn-warning">Update</button>
                        @else
                        <button type="submit" class="btn btn-primary">Add </button>
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
        var edit = $('#edit_id').val();
        if (edit == 'E') {
            $('#imagePreviewedit').show();
        }


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

        $('#depfield').change(function() {
            var selectedValue = $(this).val();
            // console.log("Selected Department Field ID: " + selectedValue);

            // Add your AJAX call or logic to handle the selected value here
            // Example of an AJAX call:
            $.ajax({
                url: '{{ route('masteradmin.depacategorysel') }}',
                method: 'POST',
                data: {
                    departmentFieldId: selectedValue,
                    _token: '{{ csrf_token() }}' // Include the CSRF token if required
                },
                success: function(response) {
                    // Handle success response

                    var dropdown = $('#depcat');
                    dropdown.empty(); // Optionally clear previous options

                    dropdown.append('<option value="">Select an option</option>'); // Default option

                    $.each(response.departcats, function(key, item) {
                        $.each(item.depcat_sub, function(key1, item1) {
                            console.log(item1);
                            dropdown.append('<option value="' + item1.id + '">' + item1.title + '</option>');
                        });

                    });
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.log("Error: " + error);
                }
            });
        });

        $('#imageUpload').change(function() {
            var input = this;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#imagePreview').attr('src', e.target.result);
                    $('#imagePreview').show(); // Show the image preview
                    $('#imagePreviewedit').hide();
                }

                reader.readAsDataURL(input.files[0]); // Convert the file to base64 string
            } else {
                $('#imagePreview').hide(); // Hide preview if no file is selected
            }
        });
    });
</script>
@endsection