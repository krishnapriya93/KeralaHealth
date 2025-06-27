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
                <div class="card-header text-white card-header-main">{{isset($edit_f) ? 'Update' : 'Add'}} Department field</div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">

                            {!! implode(' ', $errors->all('<li><span class="text-danger">:message</span></li>')) !!}
                        </div> <!-- ./alert -->
                    @endif
                   @if(isset($edit_f))
                    <form id="formiid" method="POST" action="{{ route('masteradmin.updatdepartmentfields') }}" enctype="multipart/form-data">
                    @else
                    <form id="formiid" method="POST" action="{{ route('masteradmin.storedepartmentfields') }}" enctype="multipart/form-data">
                    @endif

                    @csrf
                        <input type="hidden" name="hidden_id" value="{{$keydata->id ?? ''}}">
                        <input type="hidden" name="edit_id" value="{{$edit_f ?? ''}}">
                        <div class="row mb-3">
                            @php
                              $i=0;
                            @endphp
                            <!-- EDiting Start -->
                            <div class="row mb-3 pt-3">
                                    <div class="col-sm-6">
                                        <label for="gallerytype" class="my-1 mr-2">Department<span class="redalert"> *</span></label>
                                        <select class="form-control select2 formselect" name="department" id="department" required>
                                            <option value="">Select</option>
                                            @foreach ($department as $departments)
                                            @foreach ($departments->dep_sub as $dep_sub)
                                            <option value="{{$dep_sub->id}}" @if(isset($edit_f)) {{ $dep_sub->id == $keydata->departmentId ? 'selected' : '' }} @endif>{{$dep_sub->title}}</option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                        <span class="ErrP alert-danger menuerr redalert" style="display: none;">Please Check the downloadtype Entered</span>
                                        <span class="redalert">@error('gallerytype'){{$message}} @enderror</span>
                                    </div>

                                </div>
                            @if(isset($edit_f))

                             @if(isset($keydata->id)) @foreach(($keydata->depfd_sub) as $depfd_sub)
                             <input type="hidden"  value="{{$depfd_sub->languageid ?? ''}}" id="sel_lang{{$depfd_sub->languageid}}" name="sel_lang[]">
                            <div class="col-sm-6 mb-btm" id="div{{$depfd_sub->id}}">
                                <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Tender type in {{$depfd_sub->name}} <span class="redalert"> *</span></label>
                                <input id="title{{$depfd_sub->id}}" type="text" class="form-control title_validation @error('title') is-invalid @enderror" name="title[]" value="{{ $depfd_sub->title ?? old('title.'.$i)}}" rel="{{$depfd_sub->id}}" required autocomplete="title" placeholder="Enter {{$depfd_sub->name}} here" autofocus  >
                                <span class="ErrP redalert titleerr1" style="display: none;">Please Check the {{$depfd_sub->title}} title Entered</span>
                                <span class="ErrP redalert titleerr2" style="display: none;">Please Check the {{$depfd_sub->title}} title Entered</span>
                            </div>
                             @endforeach @endif

                            <!-- EDiting End -->
                            @else
                            @foreach($language as $langs)

                            <input type="hidden"  value="{{$langs->id ?? ''}}" id="sel_lang{{$langs->id}}" name="sel_lang[]">

                                <div class="col-sm-6 mb-btm" id="div{{$langs->id}}">
                                     <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Department field in {{$langs->name}} <span class="redalert"> *</span></label>
                                     <input id="title{{$langs->id}}" type="text" class="form-control title_validation @error('title') is-invalid @enderror" name="title[]" value="{{ $keydata->title ?? old('title.'.$i)}}" rel="{{$langs->id}}" required autocomplete="title" placeholder="Enter {{$langs->name}} here" autofocus  >
                                     <span class="ErrP redalert titleerr1" style="display: none;">Please Check the {{$langs->title}} title Entered</span>
                                     <span class="ErrP redalert titleerr2" style="display: none;">Please Check the {{$langs->title}} title Entered</span>
                                </div>
                            @php
                             $i++;
                            @endphp
                            @endforeach
                            @endif
                        </div><br>


                        <div class="row">
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
 $( document ).ready(function() {


 ///tittle validation
 $('.title_validation').on('keyup', function(e) {

if($(this).attr('rel')==1)
{
   var testres = engtitle('.title_validation', this.value);

     if (!testres) {
         // alert($(this).parent().find( ".titleerr1" ).html());
         $(this).find( ".titleerr1" ).text("Not Allowed / only english ");
         // $('.titleerr1').text("Not Allowed1 ");
        //  $('.titleerr2').hide();
         $(this).parent().find( ".titleerr1" ).show();
         $('.submitBtn').prop('disabled', true);
         // $('.titleerr1').sh
     } else {
         $('.titleerr1').hide();
         $('.titleerr2').hide();
          $('.submitBtn').prop('disabled', false);
     }


   }else if($(this).attr('rel')==2)
   {
    var testres = maltitle('.title', this.value);

       if (!testres) {

           $(this).find( ".titleerr2" ).text("Not Allowed/ only malayalam ");
        //    $('.titleerr1').hide();
           $('.submitBtn').prop('disabled', true);
       } else {

           $('.titleerr2').hide();
           $('.titleerr1').hide();
            $('.submitBtn').prop('disabled', false);
       }

    }

 });


});
</script>
@endsection
