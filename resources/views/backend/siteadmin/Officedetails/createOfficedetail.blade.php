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
            <div class="card" id="entry_div">
                <div class="card-header text-white card-header-main">{{isset($edit_f) ? 'Update' : 'Add'}} Office Details</div>
                <div class="card-body">
                    @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <input type="hidden" name="Errval" id="Errval" value="{{($errors->any()) ? '1':'2'}}">
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">

                        {!! implode(' ', $errors->all('<span class="text-danger">:message</span>')) !!}
                    </div> <!-- ./alert -->
                    @endif
                    @if(isset($edit_f))
                    <form id="formid" method="POST" action="{{ route('siteadmin.updateofficedetails') }}" enctype="multipart/form-data">
                        @else
                        <form id="formid" method="POST" action="{{ route('siteadmin.storeofficedetails') }}" enctype="multipart/form-data">
                            @endif


                            @csrf
                            <input type="hidden" name="hidden_id" value="{{$keydata->id ?? ''}}">

                            <div class="row mb-3 card-header card-main">
                                @php
                                $i=0;
                                @endphp
                                <div class="row mb-3 pt-3">
                                    <div class="col-sm-6">
                                        <label for="officeid" class="my-1 mr-2">Office<span class="redalert"> *</span></label>
                                        <select class="form-control select2 formselect" name="officeid" id="officeid" required>
                                            <option value="">Select</option>

                                            @foreach($offices as $office)

                                            @foreach($office->office_sub as $office_sub)
                                            <option value="{{$office->id}}" @if(isset($edit_f)) {{ $office->id == $keydata->officeId ? 'selected' : '' }} @endif>{{$office_sub->title}}</option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                        <span class="ErrP alert-danger menuerr redalert" style="display: none;">Please Check the downloadtype Entered</span>
                                        <span class="redalert">@error('officeid'){{$message}} @enderror</span>
                                    </div>

                                </div>


                                @if(isset($edit_f))

                                @if(isset($keydata->id)) @foreach(($keydata->officedetailsub) as $officedetailsub)
                            
                                <input type="hidden" value="{{$officedetailsub->languageid ?? ''}}" id="sel_lang{{$officedetailsub->languageid}}" name="sel_lang[]">
                                <div class="row div_lan1 mb-3 pt-3">
                                <div class="col-sm-12 mb-btm" id="div_mission{{$officedetailsub->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Mission in {{$officedetailsub->lang->name}}</label>
                                        <textarea id="mission{{$officedetailsub->id}}" type="text" class="form-control ckeditor @error('mission') is-invalid @enderror" name="mission[]" value="{{ $keydata->mission ?? old('mission')}}" rel="{{$officedetailsub->id}}" autocomplete="language" placeholder="Enter mission {{$officedetailsub->name}} here" autofocus>{{ $officedetailsub->mission ?? old('mission')}}</textarea>
                                        <span class="ErrP redalert titleerr5 display_status">Please Check the {{$officedetailsub->name}} title Entered</span>
                                        <span class="ErrP redalert titleerr6 display_status">Please Check the {{$officedetailsub->name}} title Entered</span>
                                    </div>
                                </div><br>
                                <div class="row mb-3">
                                    <div class="col-sm-12 mb-btm" id="div_vision{{$officedetailsub->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Vision in {{$officedetailsub->lang->name}}</label>
                                        <textarea id="vision{{$officedetailsub->id}}" type="text" class="form-control ckeditor @error('vision') is-invalid @enderror" name="vision[]" value="{{ $keydata->vision ?? old('vision')}}" rel="{{$officedetailsub->id}}" autocomplete="language" placeholder="Enter vision {{$officedetailsub->name}} here" autofocus>{{ $officedetailsub->vision ?? old('vision')}}</textarea>
                                        <span class="ErrP redalert titleerr5 display_status">Please Check the {{$officedetailsub->name}} title Entered</span>
                                        <span class="ErrP redalert titleerr6 display_status">Please Check the {{$officedetailsub->name}} title Entered</span>
                                    </div>
                                </div><br />

                                <div class="row mb-3">
                                    <div class="col-sm-12 mb-btm" id="div_alt{{$officedetailsub->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Description in {{$officedetailsub->lang->name}}<span class="redalert"> *</span></label>
                                        <textarea id="description{{$officedetailsub->id}}" type="text" class="form-control ckeditor @error('description') is-invalid @enderror" name="description[]" value="{{ $keydata->title ?? old('description')}}" rel="{{$officedetailsub->id}}" autocomplete="language" placeholder="Enter Alternative {{$officedetailsub->name}} here" autofocus>{{ $officedetailsub->description ?? old('description')}}</textarea>
                                        <span class="ErrP redalert titleerr5 display_status">Please Check the {{$officedetailsub->name}} title Entered</span>
                                        <span class="ErrP redalert titleerr6 display_status">Please Check the {{$officedetailsub->name}} title Entered</span>
                                    </div><br />
                                </div>

                                @endforeach @endif
                                @else
                                @foreach($language as $langs)
                                <input type="hidden" value="{{$langs->id ?? ''}}" id="sel_lang{{$langs->id}}" name="sel_lang[]">
                                <!-- <div class="col-sm-12 card-header card-custom-header bg-secondary text-white mb-3"><label for="path" class="col-sm-2 col-form-label" >{{$langs->name}}</label></div><br/>                   -->
                                <div class="row mb-3">
                                    <div class="col-sm-12 mb-btm" id="div_mission{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Mission in {{$langs->name}}</label>
                                        <textarea id="mission{{$langs->id}}" type="text" class="form-control ckeditor @error('mission') is-invalid @enderror" name="mission[]" value="{{ $keydata->mission ?? old('mission')}}" rel="{{$langs->id}}" autocomplete="language" placeholder="Enter mission {{$langs->name}} here" autofocus></textarea>
                                        <span class="ErrP redalert titleerr5 display_status">Please Check the {{$langs->name}} title Entered</span>
                                        <span class="ErrP redalert titleerr6 display_status">Please Check the {{$langs->name}} title Entered</span>
                                    </div>
                                </div><br />

                                <div class="row mb-3">
                                    <div class="col-sm-12 mb-btm" id="div_vision{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Vision in {{$langs->name}}</label>
                                        <textarea id="vision{{$langs->id}}" type="text" class="form-control ckeditor @error('vision') is-invalid @enderror" name="vision[]" value="{{ $keydata->vision ?? old('vision')}}" rel="{{$langs->id}}" autocomplete="language" placeholder="Enter vision {{$langs->name}} here" autofocus></textarea>
                                        <span class="ErrP redalert titleerr5 display_status">Please Check the {{$langs->name}} title Entered</span>
                                        <span class="ErrP redalert titleerr6 display_status">Please Check the {{$langs->name}} title Entered</span>
                                    </div>
                                </div><br />


                                <div class="row mb-3">
                                    <div class="col-sm-12 mb-btm" id="div_alt{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Description in {{$langs->name}}<span class="redalert"> *</span></label>
                                        <textarea id="description{{$langs->id}}" type="text" class="form-control ckeditor @error('description') is-invalid @enderror" name="description[]" value="{{ $keydata->title ?? old('description')}}" rel="{{$langs->id}}" autocomplete="language" placeholder="Enter Alternative {{$langs->name}} here" autofocus></textarea>
                                        <span class="ErrP redalert titleerr5 display_status">Please Check the {{$langs->name}} title Entered</span>
                                        <span class="ErrP redalert titleerr6 display_status">Please Check the {{$langs->name}} title Entered</span>
                                    </div><br />
                                </div>


                                @php
                                $i++;
                                @endphp
                                @endforeach
                                @endif
                                <div class="row">
                                    <div class="col-sm-12 mb-btm" id="div">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Web site URL <span class="redalert"> *</span></label>
                                        <input id="weburl" type="text" class="form-control weburl  @error('weburl') is-invalid @enderror" name="weburl" value="{{ $keydata->websiteurl ?? old('weburl')}}" rel="" required autocomplete="date" placeholder="Enter main here" autofocus>
                                        <span class="ErrP redalert titleerr1 display_status">Please Check the Entered</span>
                                        <span class="ErrP redalert titleerr2 display_status">Please Check Entered</span>
                                    </div><br />
                                </div>

                                
                                <div><br /></div>


                                <div class="row mb-1 pt-3">
                                    <div class="col-sm-10 offset-sm-2">
                                        @if($edit_f ?? '')
                                        <button type="submit" class="btn btn-warning">Update</button>
                                        @else
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        @endif
                                    </div>
                                </div>
                            </div><!-- .row -->
                        </form>
                </div><!-- .card-body -->
            </div><!-- .card -->

        </div><!-- .col-12 -->
    </div><!-- .row -->
</div><!-- .container -->
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {
        // if($('#Errval').val()!=1){
        //     $("#entry_div").hide();

        // }
        $('.postererr1').hide();
        $('.postererr2').hide();


        //poster view
        $('.poster').change(function() {
            var i = $(this).attr('rel');

            var value = '#preview-image-before-upload' + i;

            $('.preview_poster').show();
            let reader = new FileReader();

            reader.onload = (e) => {

                $(value).attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            // $(".poster")[0].reset();
        });

    });
    //image prevew

    $('.preview-image-before-upload').on('load', function(e) {
        var image = new Image();
        // $('.postererr1').hide();
        // $('.postererr2').hide();
        image.src = $(this).attr("src");
        var rel_id = $(this).attr('rel');
        var value = '#preview-image-before-upload' + rel_id;
        // alert(value);
        // if(rel_id==1)
        // {
        var testres = imageheightwidth(value, image.width, image.height);
        // alert(testres);

        if (testres == 'true') { //okay
            $('.postererr' + rel_id).hide();
            // $('.postererr2').hide();

        } else { //error
            $('.postererr' + rel_id).append(' ' + testres);
            $('.postererr' + rel_id).show();


        }



    });

    // validation in LAng.
    $('.title_validation').on('keyup', function(e) {

        if ($(this).attr('rel') == 1) {
            var testres = engtitle('.title', this.value);

            if (!testres) {
                // alert($(this).parent().find( ".titleerr1" ).html());
                $(this).find(".titleerr1").text("Not Allowed / only english ");
                // $('.titleerr1').text("Not Allowed1 ");
                $('.titleerr2').hide();
                $(this).parent().find(".titleerr1").show();
                // $('.titleerr1').sh
            } else {
                $('.titleerr1').hide();
                $('.titleerr2').hide();
            }
            var testres1 = engtitle('.sub_title', this.value);
            if (!testres) {
                // alert($(this).parent().find( ".titleerr1" ).html());
                $(this).find(".titleerr3").text("Not Allowed / only english ");
                // $('.titleerr1').text("Not Allowed1 ");
                $('.titleerr4').hide();
                $(this).parent().find(".titleerr3").show();
                // $('.titleerr1').sh
            } else {
                $('.titleerr3').hide();
                $('.titleerr4').hide();
            }
            var testres2 = engtitle('.alt_title', this.value);
            if (!testres) {
                // alert($(this).parent().find( ".titleerr1" ).html());
                $(this).find(".titleerr5").text("Not Allowed / only english ");
                // $('.titleerr1').text("Not Allowed1 ");
                $('.titleerr6').hide();
                $(this).parent().find(".titleerr5").show();
                // $('.titleerr1').sh
            } else {
                $('.titleerr5').hide();
                $('.titleerr6').hide();
            }
        } else if ($(this).attr('rel') == 2) {
            var testres = maltitle('.title', this.value);

            if (!testres) {
                $(this).find(".titleerr2").text("Not Allowed/ only malayalam ");
                $('.titleerr1').hide();
            } else {
                $('.titleerr2').hide();
                $('.titleerr1').hide();
            }

            var testres1 = maltitle('.sub_title', this.value);
            if (!testres) {
                $(this).find(".titleerr4").text("Not Allowed/ only malayalam ");
                $('.titleerr3').hide();

            } else {
                $('.titleerr4').hide();
                $('.titleerr3').hide();
            }

            var testres1 = maltitle('.alt_title', this.value);
            if (!testres) {
                $(this).find(".titleerr6").text("Not Allowed/ only malayalam ");
                $('.titleerr5').hide();

            } else {
                $('.titleerr6').hide();
                $('.titleerr5').hide();
            }
        }



    });
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

    // });
    $('#photo').bind('change', function(e) {
        if ($('input:submit').attr('disabled', false)) {
            $('input:submit').attr('disabled', true);
        }
        var picval = this.value;
        if (picval != '') {
            var ext = $('#photo').val().split('.').pop().toLowerCase();
            if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'webp']) == -1) {
                $('#error_photo').slideDown("slow");
                $('#photo').val('');
                $('#uploadPreview').html('');

                a = 0;
            } else {
                var picsize = (this.files[0].size);
                if (picsize > 10000000) {
                    $('#error_photo').slideDown("slow");
                    $('#photo').val('');
                    $('#uploadPreview').html('');
                    a = 0;
                } else {

                    a = 1;
                    $('#error_photo').hide();


                }
                $('#error_photo').hide();
                if (a == 1) {


                    $('input:submit').attr('disabled', false);
                    var _URL = window.URL || window.webkitURL;
                    var image, file;
                    if ((file = this.files[0])) {
                        image = new Image();
                        image.onload = function() {
                            src = this.src;
                            $('#uploadPreview').html('<img id="uploadingimg" src="' + src + '"></div>');

                            // if (((this.width >= 450) && (this.width <= 450)) && ((this.height >= 250) && (this.height <= 450))) {
                            //     $('#uploadPreview').html('<img id="uploadingimg" src="'+ src +'"></div>');
                            //     e.preventDefault();
                            //     $('#error_photo').hide();
                            //     $('#CropDiv').hide();
                            // } else {
                            //     $('#uploadPreview').html('');
                            //     img_preview();
                            // }
                        }
                    };
                    image.src = _URL.createObjectURL(file);


                } else {

                }

            }
        } else {
            $('#CropDiv').hide();
        }

    });

    function img_preview() {

        // cropper.destroy();
        // $('.cropper-hide').attr('src','');
        // $('.cropper-view-box img').attr('src','');
        var imageFiles = document.getElementById("photo"),
            files = imageFiles.files;

        var image = document.querySelector('#image');

        var testres = imageval_cropper('#photo', imageFiles.files[0], '#img_show');
        // var testres = 'false';
        // alert(testres);
        if (testres == 'true') {
            $('.postererr').html('');
            $('.postererr').hide();

            // var crpperDDivv=`<div id="crpImg" class="col-md-12 d-flex justify-content-md-start">

            // <img id="image"  src="" class="img-thumbnail" alt="...">

            // </div>`;

            // $("#crpImg").load(location.href + " #crpImg>*", crpperDDivv);

            const [file] = photo.files

            if (file) {
                // alert(URL.createObjectURL(file));
                image.src = URL.createObjectURL(file);

            }

            $('#CropDiv').show();

            $('#image').show();
            $('#poster_div').hide();
        } else {
            $('.postererr').html('');
            $('.postererr').html(testres);
            $('.postererr').show();

        }

    }

    function imageval_cropper(id, testval) {
        var file = testval;
        var fileType = file["type"];
        var filesize = file["size"];
        //alert(filesize);

        var validImageTypes = ["image/webp", "image/jpeg", "image/png", "image/jpg"];
        if ($.inArray(fileType, validImageTypes) < 0) {
            return 'Only file type: webp/jpeg/png/jpg is acceptable';
        } else {

            if (filesize > 10000000) {

                return 'Size should be less than 10 MB';
            } else {
                return 'true';
            }


        }
    }

    function showCropper() {
        var width_Image = $('#width_Image').val();
        var height_Image = $('#height_Image').val();
        var testres = imgWidthHeight_Crop_val('#height_Image', height_Image);
        if (this.value == '') {

            $('.height_Imageerror').show();
        } else {
            $('.height_Imageerror').hide();

        }
        if (!testres) {
            $('.height_Imageerror').text("Digits Only");
            $('#hiddenval').val('mdj');
            $('.height_Imageerror').show();
            $('#poster_div').hide();
        } else {
            $('.height_Imageerror').hide();
            if ((width_Image != '') && (height_Image != '')) {

                $('#poster_div').show();
            } else {
                $('#poster_div').hide();
                // swal("Warning", "Both height and Width needed", "warning");
            }
        }
        var testres = imgWidthHeight_Crop_val('#width_Image', width_Image);
        if (this.value == '') {

            $('.width_Imageerror').show();
            $('#poster_div').hide();
        } else {
            $('.width_Imageerror').hide();
            if ((width_Image != '') && (height_Image != '')) {

                $('#poster_div').show();
            } else {
                $('#poster_div').hide();
                // swal("Warning", "Both height and Width needed", "warning");
            }

        }
        if (!testres) {
            $('.width_Imageerror').text("Digits Only");
            $('#hiddenval').val('mdj');
            $('.width_Imageerror').show();
            $('#poster_div').hide();
        } else {
            $('.width_Imageerror').hide();
            if ((width_Image != '') && (height_Image != '')) {

                $('#poster_div').show();
            } else {
                $('#poster_div').hide();
                // swal("Warning", "Both height and Width needed", "warning");
            }
        }


    }
    var img = document.querySelector("#image"),
        observer = new MutationObserver((changes) => {
            changes.forEach(change => {
                if (change.attributeName.includes('src')) {
                    var image = document.querySelector('#image');
                    // $('.cropper-hide').attr('src',image.src);
                    // $('.cropper-view-box img').attr('src',image.src);
                    var cropBoxData = document.querySelector('#cropBoxData');

                    var button = document.getElementById('button');
                    var result = document.getElementById('result');
                    var height_Image = 150;
                    var width_Image = 150;
                    var init_data = {
                        /*width: parseFloat($("#width_Image").val()),
                        height: parseFloat($("#height_Image").val())*/
                        width: parseFloat(150),
                        height: parseFloat(150)
                    };


                    var croppable = false;
                    $('#resultlabels').hide();
                    var cropper = new Cropper(image, {
                        viewMode: 1,
                        ready: function() {
                            croppable = true;
                        },

                        crop: function(event) {

                            // data.textContent = JSON.stringify(cropper.getData());
                            var jsonStringify = JSON.stringify(cropper.getData());
                            jQuery('#height').val(parseFloat(150));
                            jQuery('#width').val(parseFloat(150));
                            var height = JSON.stringify(cropper.getData(), ['height']);
                            var width = JSON.stringify(cropper.getData(), ['width']);
                            height = JSON.parse(height);
                            width = JSON.parse(width);
                            var texthtml = "<b> Height: </b>" + height.height.toFixed(0) + "px " + "<b> Width: </b>" + width.width.toFixed(0) + "px";
                            $('#dataImg').html(texthtml);

                        },
                        data: init_data,
                        zoom: function(event) {
                            if (event.detail.oldRatio === 1) {
                                event.preventDefault();
                            }
                        },
                    });
                    $('#resultlabels').hide();
                    cropper.reset();
                    cropper.clear();
                    cropper.destroy();
                    $('.cropper-container').remove();
                    cropper = new Cropper(image, {

                        viewMode: 1,
                        ready: function() {
                            croppable = true;
                        },

                        crop: function(event) {

                            // data.textContent = JSON.stringify(cropper.getData());
                            var jsonStringify = JSON.stringify(cropper.getData());
                            jQuery('#height').val(parseFloat(150));
                            jQuery('#width').val(parseFloat(150));
                            var height = JSON.stringify(cropper.getData(), ['height']);
                            var width = JSON.stringify(cropper.getData(), ['width']);
                            height = JSON.parse(height);
                            width = JSON.parse(width);
                            var cropht = height.height.toFixed(0);
                            var cropwt = width.width.toFixed(0);
                            var texthtml = "<b> Height: </b>" + height.height.toFixed(0) + "px " + "<b> Width: </b>" + width.width.toFixed(0) + "px";
                            $('#dataImg').html(texthtml);

                        },
                        data: init_data,

                        zoom: function(event) {
                            if (event.detail.oldRatio === 1) {
                                event.preventDefault();
                            }
                        },
                    });
                    button.onclick = function() {
                        result.innerHTML = '';
                        result.appendChild(cropper.getCroppedCanvas({
                            height: 800,
                            width: 800,
                            imageSmoothingEnabled: true,
                            imageSmoothingQuality: 'high',
                        }));
                        var canvasData = document.getElementById('destCanvas');
                        var dataURL_img = canvasData.toDataURL('image/jpeg', 1);
                        var cropdheight = canvasData.height;
                        var cropdwidth = canvasData.width;
                        $('#cropdht').html(cropdheight + " px");
                        $('#cropdwt').html(cropdwidth + " px");
                        $('#hiddenval').val(dataURL_img);

                        // $('#image').attr('src', '');

                        $('#resultlabels').html('Cropped photo.');



                        $('#button').show();
                        // $('#button_change').show();


                    };
                }
            });
        });
    observer.observe(img, {
        attributes: true
    });
</script>
@endsection