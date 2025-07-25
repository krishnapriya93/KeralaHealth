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
                <div class="card-header text-white card-header-main">{{isset($edit_f) ? 'Update' : 'Add'}} Mainmenu</div>

                <div class="card-body">
                  @if(session('success'))
                      <div class="alert alert-success" role="alert">
                           {{ session('success') }}
                       </div>
                   @endif

                    @if(session('error'))
                      <div class="alert alert-warning" role="alert">
                           {{ session('error') }}
                       </div>
                   @endif

                   @if(isset($edit_f))
                    <form id="formiid" method="POST" action="{{ route('updateMainmenu') }}" enctype="multipart/form-data">
                    @else
                    <form id="formiid" method="POST" action="{{ route('storeMainmenu') }}" enctype="multipart/form-data">
                    @endif

                    @csrf
                        <input type="hidden" name="hidden_id" value="{{$keydata->id ?? ''}}">
                        <input type="hidden" name="menulinktype_id_edit" id="menulinktype_id_edit" value="{{$keydata->menulinktype_id ?? ''}}">
                        <input type="hidden" id="edit_id" name="edit_id" value="{{$edit_f ?? ''}}">
                        <input type="hidden" id="article_id_edit" name="article_id_edit" value="{{$keydata->menulinktype_data ?? ''}}">


                        <div class="row mb-3">
                           @if(isset($edit_f))

                           @if(isset($keydata->id)) @foreach(($keydata->mainmenu_sub) as $mainsub)
                           <input type="hidden"  value="{{$mainsub->languageid ?? ''}}" id="sel_lang{{$mainsub->languageid}}" name="sel_lang[]">
                                <div class="col-sm-6 mb-btm" id="div{{$mainsub->id}}">
                                     <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Mainmenu title <span class="redalert"> *</span></label>

                                    <input id="title{{$mainsub->id}}" type="text" class="form-control title @error('title') is-invalid @enderror" name="title[]"  rel="{{$mainsub->languageid}}" value="{{$mainsub->title}}" required autocomplete="title" placeholder="Enter  here" autofocus  >
                                      <span class="ErrP redalert titleerr1" style="display: none;">Please Check the {{$mainsub->title}} title Entered</span>
                                     <span class="ErrP redalert titleerr2" style="display: none;">Please Check the {{$mainsub->title}} title Entered</span>
                                </div>
                           @endforeach @endif
                           @else
                           @foreach($language as $langs)

                            <input type="hidden"  value="{{$langs->id ?? ''}}" id="sel_lang{{$langs->id}}" name="sel_lang[]">
                              <div class="col-sm-6 mb-btm" id="div{{$langs->id}}">
                                     <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Mainmenu title in {{$langs->name}} <span class="redalert"> *</span></label>

                                    <input id="title{{$langs->id}}" type="text" class="form-control title @error('title') is-invalid @enderror" name="title[]"  rel="{{$langs->id}}" value="" required autocomplete="title" placeholder="Enter {{$langs->name}} here" autofocus  >
                                     <span class="ErrP redalert titleerr1" style="display: none;">Please Check the {{$langs->name}} title Entered</span>
                                     <span class="ErrP redalert titleerr2" style="display: none;">Please Check the {{$langs->name}} title Entered</span>
                                </div>
                             @endforeach
                             @endif

                        </div><br>
                           <div class="row mb-3">
                            <label for="icon_class" class="col-sm-2 col-form-label">Icon Class</label>
                            <div class="col-sm-10">
                            <input id="icon_class" type="text" class="form-control @error('icon_class') is-invalid @enderror" name="icon_class" value="{{ $keydata->iconclass ?? old('iconclass')}}" autocomplete="icon_class" placeholder="Eg: lni lni-search-alt" autofocus>
                            <span class="ErrP alert-danger redalert iconerr" style="display: none;">Please Check the icon_class Entered</span>
                            <span class="redalert">@error('icon_class'){{$message}} @enderror</span>
                            </div>
                        </div>

                         <div class="row mb-3">
                            <label for="menulinktype" class="col-sm-2 col-form-label">Menulink Type<span class="redalert"> *</span></label>
                            <div class="col-sm-10">
                             <select class="form-control select2 formselect" name="menulinktype" id="menulinktype" required>
                                <option value="">Select</option>
                            @foreach($Menulinktype as $Menulinktypes)
                                <option value="{{$Menulinktypes->id}}" rel="{{$Menulinktypes->name}}" @if(isset($edit_f))  {{($Menulinktypes->id == $keydata->menu_link_type->id) ? 'selected' : ''}} @endif >{{$Menulinktypes->name}}</option>
                            @endforeach
                            </select>
                            <span class="ErrP alert-danger menuerr redalert" style="display: none;">Please Check the menulinktype Entered</span>
                            <span class="redalert">@error('menulinktype'){{$message}} @enderror</span>
                            </div>
                        </div>

                        <!-- MenuType Anchor -->
                         <div class="row mb-3" id="div_anchor" @if(isset($keydata->menulinktype_id)) @if($keydata->menulinktype_id) != 11) style="display:none;" @endif @endif>
                            <label for="div_anchor" class="col-sm-2 col-form-label">Anchor<span class="redalert"> *</span></label>
                            <div class="col-sm-10">
                              <input id="Anchor" type="text" class="form-control @error('Anchor') is-invalid @enderror" name="Anchor" autocomplete="Anchor" placeholder="Eg: https://example.com"   @if(isset($edit_f)) @if($keydata->menulinktype_id == 11)  value="{{ $keydata->menulinktype_data}}" @endif @endif>
                            <span class="ErrP alert-danger Ancherr redalert" style="display: none;">Please Check the Anchor Entered</span>
                            <span class="redalert">@error('Anchor'){{$message}} @enderror</span>
                            </div>
                        </div>

                        <!-- MenuType Url -->
                         <div class="row mb-3" id="div_url"   @if(isset($keydata->menulinktype_id)) @if($keydata->menulinktype_id) != 12) style="display:none;" @endif @endif>
                            <label for="div_url" class="col-sm-2 col-form-label">URL<span class="redalert"> *</span></label>
                            <div class="col-sm-10">
                              <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" autocomplete="url" placeholder="Eg: example"  @if(isset($edit_f)) @if($keydata->menulinktype_id == 12)  value="{{ $keydata->menulinktype_data}}" @endif @endif>
                            <span class="ErrP alert-danger urlerr redalert" style="display: none;">Please Check the url Entered</span>
                            <span class="redalert">@error('url'){{$message}} @enderror</span>
                            </div>
                        </div>

                        <!-- MenuType File -->
                         <div class="row mb-3" id="div_file"   @if(isset($keydata->menulinktype_id)) @if($keydata->menulinktype_id) != 13) style="display:none;" @endif @endif>
                            <label for="div_file" class="col-sm-2 col-form-label">File<span class="redalert"> *</span></label>
                            <div class="col-sm-10">
                              <input id="file_type" type="file" class="form-control @error('file_type') is-invalid @enderror" name="file_type"  autocomplete="file_type" placeholder="Eg: /example" enctype = "multipart/form-data" >
                              @if(isset($edit_f)) <a href="{{ asset('/uploads/Mainmenu/'.$keydata->menulinktype_data)}}"  target=blank >view document</a> @endif
                              <span class="ErrP alert-danger fileerr redalert" style="display: none;">Please Check the file Entered</span>
                            <span class="redalert">@error('file'){{$message}} @enderror</span>
                            </div>
                        </div>


                        <!-- MenuType route -->
                        <div class="row mb-3" id="div_route"   @if(isset($keydata->menulinktype_id)) @if($keydata->menulinktype_id) != 16) style="display:none;" @endif @endif>
                            <label for="div_route" class="col-sm-2 col-form-label">Route<span class="redalert"> *</span></label>
                            <div class="col-sm-10">
                              <input id="route" type="text" class="form-control @error('route') is-invalid @enderror" name="route"  autocomplete="route" placeholder="Eg:example" @if(isset($edit_f)) @if($keydata->menulinktype_id == 16)  value="{{ $keydata->menulinktype_data}}" @endif @endif enctype = "multipart/form-data" >
                            <span class="ErrP alert-danger routeerr redalert" style="display: none;">Please Check the filroutee Entered</span>
                            <span class="redalert">@error('route'){{$message}} @enderror</span>
                            </div>
                        </div>

                         <!-- MenuType Article -->
                         <div class="row mb-3" id="div_article"   @if(isset($keydata->menulinktype_id)) @if($keydata->menulinktype_id) != 14) style="display:none;" @endif @endif>

                         <label for="div_article" class="col-sm-2 col-form-label">Article<span class="redalert"> *</span></label>
                            <div class="col-sm-10">

                            <select class="form-control select2 formselect" name="articletype" id="articletype">


                            @foreach($arttype as $arttypeon)

                                @foreach($arttypeon->articletype_sub as $artsub)
                                    <option value="{{$artsub->id}}" rel="{{$artsub->title}}" @if(isset($edit_f))  {{($artsub->articletypeid == $keydata->article_id) ? 'selected' : ''}} @endif >{{$artsub->title}}</option>
                                @endforeach
                            @endforeach
                            </select>
                            <span class="ErrP alert-danger articleerr redalert" style="display: none;">Please Check the Article type Entered</span>
                            <span class="redalert">@error('articletype'){{$message}} @enderror</span>
                            </div>
                        </div>

                         <!-- MenuType Downloads -->
                         <div class="row mb-3" id="div_download"   @if(isset($keydata->menulinktype_id)) @if($keydata->menulinktype_id) != 21) style="display:none;" @endif @endif>

                         <label for="div_download" class="col-sm-2 col-form-label">Download type<span class="redalert"> *</span></label>
                            <div class="col-sm-10">

                            <select class="form-control select2 formselect" name="downloadtype" id="downloadtype">



                            </select>

                              <!-- <input id="articletype" type="text" class="form-control @error('articletype') is-invalid @enderror" name="articletype"  autocomplete="file" placeholder="Eg: /example" @if(isset($edit_f)) @if($keydata->menulinktype_id == 14)  value="{{ $keydata->menulinktype_data}}" @endif @endif> -->
                            <span class="ErrP alert-danger downloaderr redalert" style="display: none;">Please Check the download type Entered</span>
                            <span class="redalert">@error('downloadtype'){{$message}} @enderror</span>
                            </div>
                        </div>


                        <!-- MenuType Form -->
                         <div class="row mb-3" id="div_form" @if(isset($keydata->menulinktype_id)) @if($keydata->menulinktype_id) != 15) style="display:none;" @endif @endif>
                            <label for="Form" class="col-sm-2 col-form-label">Form<span class="redalert"> *</span></label>
                            <div class="col-sm-10">
                              <input id="forms" type="text" class="form-control @error('forms') is-invalid @enderror" name="forms" autocomplete="forms" placeholder="Eg: /example" >
                            <span class="ErrP alert-danger formerr redalert" style="display: none;">Please Check the forms type Entered</span>
                            <span class="redalert">@error('forms'){{$message}} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="ord_num" class="col-sm-2 col-form-label">Order number<span class="redalert"> *</span></label>
                            <div class="col-sm-10">
                                <input id="ord_num" type="text" class="form-control @error('ord_num') is-invalid @enderror" name="ord_num" value="{{ $keydata->orderno ?? $orderno}}" required autocomplete="ord_num" placeholder="Enter order number here" autofocus>
                                <span class="ErrP article-poster-img keyiderr" style="display: none;"> <i class="lni lni-warning redalert"></i> Same Order number Already exist </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                               @if($edit_f ?? '')
                                <button type="submit" class="btn btn-warning submitBtn">Update</button>
                               @else
                               <button type="submit" class="btn btn-primary submitBtn">Add </button>
                               @endif
                               <a type="submit" class="btn btn-success" href="{{route('mainmenu')}}">Refresh</a>
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
 $( document ).ready(function() {
    //check Order number
$( "#ord_num" ).on( "keyup", function() {
    var orderno = $(this).val();


    $('.keyiderr').hide();
    $.ajax({
        url: "{{route('siteadmin.ordernumbercheckmainmenu')}}",
        type : 'GET',
        data: {'orderno':orderno,'sbutype_id':sbutype_id,'viewer_id':viewer_id},
        success: function(response){
        console.log(response);

          if(response==0)
          {
            $('.keyiderr').hide();
            $('.submitBtn').prop('disabled', false);
          }else{
            $('.keyiderr').show();
            $('.submitBtn').prop('disabled', true);
          }
    }});
} );

    var edit=$('#edit_id').val();

    var menutype = $("#menulinktype option:selected").attr('rel');
         $('#div_anchor').hide();
         $('#div_url').hide();
         $('#div_file').hide();
         $('#div_article').hide();
         $('#div_form').hide();
         $('.div_lan1').hide();
         $('.div_lan2').hide();
         $('#div_route').hide();
         $('#div_download').hide();
    // validation in LAng.
    $('.title').on('keyup', function(e) {
        if($(this).attr('rel')==1)
        {
              var testres = engtitle('.title', this.value);
                if (!testres) {
                    // alert($(this).parent().find( ".titleerr1" ).html());
                    $(this).find( ".titleerr1" ).text("Not Allowed / only english ");
                    // $('.titleerr1').text("Not Allowed1 ");
                    $('.titleerr2').hide();
                    $(this).parent().find( ".titleerr1" ).show();
                    // $('.titleerr1').show();

                } else {
                    $('.titleerr1').hide();
                    $('.titleerr2').hide();
                }
            }else if($(this).attr('rel')==2)
            {
                 var testres = maltitle('.title', this.value);
                if (!testres) {
                    // $('.titleerr2').text("Not Allowed2");
                      $(this).find( ".titleerr2" ).text("Not Allowed/ only malayalam ");
                    $('.titleerr1').hide();
                    // $(this).parent().find( ".titleerr2" ).show();
                    // $('.titleerr2').show();

                } else {
                    $('.titleerr2').hide();
                    $('.titleerr1').hide();
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
   $(".radioval").click(function () {

    var val=$(this).attr('value');
    var check =  $(this).prop('checked');

    if(check)
    {

        if($(this).attr('value') != '') {
            $('.div_lan1').show();
            $('.div_lan2').show();
            $('#div'+val).show();
            $('#div_alt'+val).show();
            $('#div_poster'+val).show();
            $('#div_sub'+val).show();
            $('#div_cont'+val).show();
       }

       else {

            $('#div'+val).hide();
            $('#div_poster'+val).hide();
            $('#div_sub'+val).hide();
            $('#div_alt'+val).hide();
            $('#div_cont'+val).hide();
       }

    }else{

         $('#div'+val).hide();
         $('#div_sub'+val).hide();
         $('#div_poster'+val).hide();
         $('.div_lan1').hide();
         $('.div_lan2').hide();
         $('#div_alt').hide();
         $('#div_cont'+val).hide();
         $("#sel_lang"+val).prop('checked', false);
    }


   });



//menu link type
  $('#menulinktype').on('change ', function(e) {
    var menutype = $("#menulinktype option:selected").attr('rel');

    if (menutype == 'Anchor') {
         $('#div_anchor').show();
         $('#div_url').hide();
         $('#div_file').hide();
         $('#div_article').hide();
         $('#div_form').hide();
         $('#div_route').hide();
         $('#div_download').hide();
    }else if (menutype == 'URL'){
        $('#div_anchor').hide();
        $('#div_url').show();
        $('#div_file').hide();
        $('#div_form').hide();
        $('#div_article').hide();
        $('#div_route').hide();
        $('#div_download').hide();
    }else if(menutype =='File'){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').show();
        $('#div_form').hide();
        $('#div_article').hide();
        $('#div_route').hide();
        $('#div_download').hide();
    }else if((menutype =='Article')  || (menutype == 'Multiple Article') ){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').hide();
        $('#div_form').hide();
        $('#div_article').show();
        $('#div_route').hide();
        $('#div_download').hide();
        var sbu_user=$('#sbu_user').val();
        // alert("ddddd");
        $.ajax({
        url: "{{route('admin.articleload')}}",
        type : 'GET',
        data: {'sbu_user':sbu_user},
        success: function(response){
        console.log(response);
          // $('#unit').append(unit);
          var length = response.length;

          $('#articletype').empty();
            $('#articletype').append($('<option></option>').val('').html('Select'));
            $.each(response, function(index, element) {
                console.log(element.articletype_sub);
                $.each(element.articletype_sub, function(index1, element1) {
                    // console.log(element1);
                    $('#articletype').append(
                    $('<option></option>').val(element1.articletypeid).html(element1.title)
                );
                })

            })
    }});

    }else if(menutype =='Form'){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').hide();
        $('#div_form').show();
        $('#div_article').hide();
        $('#div_route').hide();
        $('#div_download').hide();
    }
    else if(menutype =='Sub'){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').hide();
        $('#div_form').hide();
        $('#div_article').hide();
        $('#div_route').hide();
        $('#div_download').hide();
    }
    else if(menutype =='Route'){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').hide();
        $('#div_form').hide();
        $('#div_article').hide();
        $('#div_route').show();
        $('#div_download').hide();
    }    else if(menutype =='Downloads'){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').hide();
        $('#div_form').hide();
        $('#div_article').hide();
        $('#div_route').hide();
        $('#div_download').show();

        var sbu_user=$('#sbu_user').val();
        var download_id_edit =$('#article_id_edit').val();
            // alert(article_id_edit);
                $.ajax({
                url: "{{route('admin.downloadtypeload')}}",
                type : 'GET',
                data: {'sbu_user':sbu_user},
                success: function(response){
                // console.log(response);
                // $('#unit').append(unit);
                var length = response.length;


                var length = response.length;
        //   alert(mainmenu_edit);
          $('#downloadtype').empty();

            $.each(response, function(index, element) {

                $.each(element.downloadtype_sub, function(index1, element1) {

                    if(download_id_edit==element1.downloadtypeid){
                        console.log(element1.downloadtypeid);
                        $('#downloadtype').append(
                    $('<option></option>').val(element1.downloadtypeid).html(element1.title).attr('selected','selected')
                );
                    }else{

                        $('#downloadtype').append(
                    $('<option></option>').val(element1.downloadtypeid).html(element1.title)
                );
                    }

                })

            })
            }});

    }
    });


if(edit=='E')
    {
        var menulinktype_id_edit=$('#menulinktype_id_edit').val();
        if (menulinktype_id_edit == 11) {
         $('#div_anchor').show();
         $('#div_url').hide();
         $('#div_file').hide();
         $('#div_article').hide();
         $('#div_form').hide();
         $('#div_route').hide();
         $('#div_download').hide();
    }else if (menulinktype_id_edit == 12){
        $('#div_anchor').hide();
        $('#div_url').show();
        $('#div_file').hide();
        $('#div_form').hide();
        $('#div_article').hide();
        $('#div_route').hide();
        $('#div_download').hide();
    }else if(menulinktype_id_edit ==13){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').show();
        $('#div_form').hide();
        $('#div_article').hide();
        $('#div_route').hide();
        $('#div_download').hide();
    }else if((menulinktype_id_edit ==14)  || (menulinktype_id_edit == 20)){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').hide();
        $('#div_form').hide();
        $('#div_article').show();
        $('#div_route').hide();
        $('#div_download').hide();
                 //SORT ARTICLE

            var sbu_user=$('#sbu_user').val();
            var article_id_edit =$('#article_id_edit').val();
            // alert(article_id_edit);
                $.ajax({
                url: "{{route('admin.articleload')}}",
                type : 'GET',
                data: {'sbu_user':sbu_user},
                success: function(response){
                // console.log(response);
                // $('#unit').append(unit);
                var length = response.length;

                $('#articletype').empty();
                    // $('#articletype').append($('<option></option>').val('').html('Select'));
                    $.each(response, function(index, element) {
                        console.log(element.articletype_sub);
                        $.each(element.articletype_sub, function(index1, element1) {
                            console.log(element1);
                            if(article_id_edit==element1.articletypeid){
                                $('#articletype').append(
                            $('<option></option>').val(element1.articletypeid).html(element1.title) ).attr('selected','selected');
                            }else{
                                $('#articletype').append(
                            $('<option></option>').val(element1.articletypeid).html(element1.title) );
                            }

                        })

                    })
            }});

    }else if(menulinktype_id_edit ==15){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').hide();
        $('#div_form').show();
        $('#div_article').hide();
        $('#div_route').hide();
        $('#div_download').hide();
    }
    else if(menulinktype_id_edit ==16){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').hide();
        $('#div_form').hide();
        $('#div_article').hide();
        $('#div_route').show();
        $('#div_download').hide();
    }
    else if(menulinktype_id_edit ==17){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').hide();
        $('#div_form').hide();
        $('#div_article').hide();
        $('#div_route').hide();
        $('#div_download').hide();
    }else if(menulinktype_id_edit ==21){
        $('#div_anchor').hide();
        $('#div_url').hide();
        $('#div_file').hide();
        $('#div_form').hide();
        $('#div_article').hide();
        $('#div_route').hide();
        $('#div_download').show();

            var sbu_user=$('#sbu_user').val();
            var download_id_edit =$('#article_id_edit').val();
            // alert(article_id_edit);
                $.ajax({
                url: "{{route('admin.downloadtypeload')}}",
                type : 'GET',
                data: {'sbu_user':sbu_user},
                success: function(response){
                // console.log(response);
                // $('#unit').append(unit);
                var length = response.length;


                var length = response.length;
        //   alert(mainmenu_edit);
          $('#downloadtype').empty();

            $.each(response, function(index, element) {

                $.each(element.downloadtype_sub, function(index1, element1) {

                    if(download_id_edit==element1.downloadtypeid){
                        console.log(element1.downloadtypeid);
                        $('#downloadtype').append(
                    $('<option></option>').val(element1.downloadtypeid).html(element1.title).attr('selected','selected')
                );
                    }else{

                        $('#downloadtype').append(
                    $('<option></option>').val(element1.downloadtypeid).html(element1.title)
                );
                    }

                })

            })
            }});

    }

        $('.card-main').hide();
    }else{
 $('.card-main').show();
    }
});
</script>
@endsection
