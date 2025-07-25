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
               @if(Session::get('success')!='')
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong>   {{Session::get('success')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if(session('delete'))
                    <div class="alert alert-warning" role="alert">
                       {{ session('delete') }}
                       <strong>Success!</strong>   {{Session::get('success')}}
                           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <div class="card">
                <div class="card-header text-white card-header-main">{{isset($edit_f) ? 'Update' : 'Add'}} Designation</div>

                <div class="card-body">

                   @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {!! implode(' ', $errors->all('<span class="text-danger">:message</span>')) !!}
                        </div> <!-- ./alert -->
                    @endif
                    
                   @if(isset($edit_f))
                    <form id="formiid" method="POST" action="{{ route('masteradmin.updatedesignation') }}" enctype="multipart/form-data">
                    @else
                    <form id="formiid" method="POST" action="{{ route('masteradmin.storedesignation') }}" enctype="multipart/form-data">
                    @endif
                    @csrf 
                        @php 
                         $i=0;
                        @endphp
                        <input type="hidden" name="hidden_id" value="{{$keydata->id ?? ''}}">
                        <div class="row mb-3">
                        @if(isset($edit_f)) 

                            @if(isset($keydata->id)) @foreach(($keydata->des_sub) as $des_sub)

                            <input type="hidden"  value="{{$des_sub->languageid ?? ''}}" id="sel_lang{{$des_sub->languageid}}" name="sel_lang[]">

                            <div class="col-sm-6 mb-btm" id="div{{$des_sub->id}}"> 
                            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Designation in {{$des_sub->name}} <span class="redalert"> *</span></label>
                            <input id="title{{$des_sub->id}}" type="text" class="form-control title_validation @error('title') is-invalid @enderror" name="title[]" value="{{ $des_sub->title ?? old('title.'.$i)}}" rel="{{$des_sub->id}}" required autocomplete="title" placeholder="Enter {{$des_sub->name}} here" autofocus  >
                            <span class="ErrP redalert titleerr1" style="display: none;">Please Check the {{$des_sub->title}} title Entered</span>
                            <span class="ErrP redalert titleerr2" style="display: none;">Please Check the {{$des_sub->title}} title Entered</span>
                            </div>
                            @endforeach @endif

                            <!-- EDiting End -->
                            @else
                      
           
                            @foreach($language as $langs)

                            <input type="hidden"  value="{{$langs->id ?? ''}}" id="sel_lang{{$langs->id}}" name="sel_lang[]">

                                <div class="col-sm-6 mb-btm" id="div{{$langs->id}}"> 
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Designation in {{$langs->name}} <span class="redalert"> *</span></label>
                                    <input id="title{{$langs->id}}" type="text" class="form-control title title_validation @error('title') is-invalid @enderror" name="title[]" rel="{{$langs->id}}" value="{{ $keydata->title ?? old('title.'.$i)}}" required autocomplete="title" placeholder="Enter {{$langs->name}} here" autofocus  >
                                    <span class="ErrP redalert titleerr1 display_status">Please Check the {{$langs->name}} title Entered</span>
                                    <span class="ErrP redalert titleerr2 display_status">Please Check the {{$langs->name}} title Entered</span>
                                </div>
                            @php 
                                $i++;
                            @endphp
                            
                            @endforeach  @endif

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
            <div class="card">
                <div class="card-header text-white card-header-main">{{ __('List of Designation') }}</div>
                 
                <div class="card-body">
                    <table id="datatable_view" class="table table-striped">
                    <thead>    
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $key => $result)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $result->des_sub[0]->title }}</td>
                        <td>
                            @if(($result->status_id)==1)
                            <a class="main-btn info-btn rounded-full btn-hover btn-sm-default" href="{{ route('masteradmin.statusdesignation',\Crypt::encryptString($result->id)) }}">Active</a>
                            @else
                            <a class="main-btn deactive-btn rounded-full btn-hover btn-sm-default" href="{{ route('masteradmin.statusdesignation',\Crypt::encryptString($result->id)) }}">Deactive</a>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('masteradmin.editdesignation',\Crypt::encryptString($result->id)) }}">Edit</a>
                            <a class="btn btn-danger btn-sm" href="{{ route('masteradmin.deletedesignation',\Crypt::encryptString($result->id)) }}">Delete</a>
                        </td>
                    </tr>   
                    @endforeach    
                    </tbody>    
                    </table>    
  
                </div>
            </div> <!--card2 -->

        </div>
    </div>
</div>
@endsection
@section('page_scripts')
<script>  
 $( document ).ready(function() {

///tittle validation
var flag=0;
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
         $('#submitBtn').prop('disabled', true);
        flag=1;
         // $('.titleerr1').sh
     } else {
    
         $('.titleerr1').hide();
         flag=0;
        //  $('.titleerr2').hide();
          $('#submitBtn').prop('disabled', false);
     }
    
   
   }else if($(this).attr('rel')==2)
   {
    var testres = maltitle('.title', this.value);

       if (!testres) {
    
           $(this).find( ".titleerr2" ).text("Not Allowed/ only malayalam ");
           $(this).parent().find( ".titleerr2" ).show();
        //    $('.titleerr1').hide();
           $('.submitBtn').prop('disabled', true);
           flag=1;
       } else {
    
           $('.titleerr2').hide();
           flag=0;

        //    $('.titleerr1').hide();
            $('.submitBtn').prop('disabled', false);
       }

    }
});
//common alert display time set

    $(".alert").fadeTo(2000, 500).slideUp(500, function() {
      $(".alert").slideUp(500);
    });
   
    $('.alert').alert();
  });    
</script>
@endsection
