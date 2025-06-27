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
                <div class="card-header text-white card-header-main">{{isset($edit_f) ? 'Update' : 'Add'}} Survey Details</div>

                <div class="card-body">
                  @if(session('success'))
                      <div class="alert alert-success" role="alert">
                           {{ session('success') }}
                       </div>
                   @endif
                   @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                        
                            {!! implode(' ', $errors->all('<li><span class="text-danger">:message</span></li>')) !!}
                        </div> <!-- ./alert -->
                    @endif
                   @if(isset($edit_f))
                    <form id="formiid" method="POST" action="{{ route('siteadmin.updatepoll') }}" enctype="multipart/form-data">
                    @else
                    <form id="formiid" method="POST" action="{{ route('siteadmin.storepoll') }}" enctype="multipart/form-data">
                    @endif
    
                    @csrf 
                        <input type="hidden" name="hidden_id" value="{{$keydata->id ?? ''}}">
                        <input type="hidden" id="edit_id" name="edit_id" value="{{$edit_f ?? ''}}">
           
                        <!-- <div class="row mb-3 card-header card-main"> -->
             
                       
                        <!-- <label class="my-1 mr-2"><span class="redalert">* Please select language and fill data</span></label><br> -->
                        <div class="row div_lan1 mb-3 card-header card-main">
                            <div class="col-sm-12 card-header card-custm-header">
                                <label for="path" class="col-sm-5 col-form-label" >Question  </label>
                            </div>
                            @if(isset($edit_f)) 
                            @if(isset($keydata->id)) @foreach(($keydata->Pollquestionsub) as $Pollquestionsub)
                            <input type="hidden" id="sel_lang{{$Pollquestionsub->languageid}}" name="sel_lang[]" class="form-check-input radioval" value="{{$Pollquestionsub->languageid}}">
                                
                                <div class="form-group row div_lan1 px-2 pt-3">
                                    <label for="inlineFormCustomSelectPref" class="col-sm-3 my-1 mr-2 col-form-label">Question in {{$Pollquestionsub->name}} <span class="redalert"> *</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('question') is-invalid @enderror my-1 mr-2" id="question{{$Pollquestionsub->id}}" name="question[]" value="{{$Pollquestionsub->question}}" placeholder="Enter question {{$Pollquestionsub->name}} here">
                                    </div>
                                </div>
                            @endforeach 
                                <!-- <div class="row div_lan1 mb-3 card-header card-main"> -->
                                <div class="col-sm-12 card-header card-custm-header mt-3">
                                    <label for="path" class="col-sm-5 col-form-label" >Answer</label>
                                </div>
                          
                            
                            
                                @foreach($answer->pollanswersub as $answers)
                                
                                <table class="table" id="dynamicTable1">  
                                <tr>  
                                
                                    <td><input type="text" id="sel_lang[1]" value="{{$answers->answer}}" name="enganswer[]" placeholder="Enter answer in english" class="form-control" /></td>  
                                   
                                    <td><input type="text" id="sel_lang[2]" value="{{$answers->answer}}" name="malanswer[]" placeholder="Enter answer in malayalam" class="form-control" /></td>  
                                
                                    <td><button type="button" name="add1" id="add1" class="btn btn-success">Add More</button></td>  
                                                                      
                                </tr>    
                                </table> 
                                @endforeach   
                                
                            @endif 
                            @else    
                            @foreach($language as $langs)
                                    <input type="hidden" id="sel_lang{{$langs->id}}" name="sel_lang[]" class="form-check-input radioval" value="{{$langs->id}}">
                                
                                        <div class="form-group row div_lan1 px-2 pt-3">
                                            <label for="inlineFormCustomSelectPref" class="col-sm-3 my-1 mr-2 col-form-label">Question in {{$langs->name}} <span class="redalert"> *</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control @error('question') is-invalid @enderror my-1 mr-2" id="question{{$langs->id}}" name="question[]" value="" placeholder="Enter question {{$langs->name}} here">
                                            </div>
                                        </div>
                                @endforeach
                                <!-- <div class="row div_lan1 mb-3 card-header card-main"> -->
                                <div class="col-sm-12 card-header card-custm-header mt-3">
                                    <label for="path" class="col-sm-5 col-form-label" >Answer</label>
                                </div>
                                    <table class="table" id="dynamicTable1">  
                                        <tr>  
                                            <td><input type="text" id="sel_lang[1]" name="enganswer[]" placeholder="Enter answer in english" class="form-control" /></td>  
                                            <td><input type="text" id="sel_lang[2]" name="malanswer[]" placeholder="Enter answer in malayalam" class="form-control" /></td>  
                                            <td><button type="button" name="add1" id="add1" class="btn btn-success">Add More</button></td>  
                                        </tr>  
                                    </table> 
                            @endif
                        </br>

                                
                        </div> <!--row-->

                        <div class="row">
                            <div class="card-style mb-30">
                                    <div class="form-check form-switch toggle-switch ">
                                        <label class="form-check-label" for="toggleSwitch2" >Multi choice enable</label>
                                        <input class="form-check-input" type="checkbox" value="1" id="multichoice" name="multichoice"  @if(isset($edit_f)){{ ($keydata->multi_choice_flag == 1)   ? 'checked' : '' }}  @else checked @endif>
                                    </div>
                            </div>
                        </div>
                                   
            
                                    <div class="row">
                                        <div class="col-sm-10 offset-sm-2">
                                        @if($edit_f ?? '')
                                            <button type="submit" class="btn btn-warning stn-btn">Update</button>
                                        @else
                                        <button type="submit" class="btn btn-primary ">Add </button>
                                        @endif
                                      
                                        </div>
                                    </div>
                    </form>

                </div><!--card body -->

            </div><!--card-->
        </div><!--col 12-->
    </div><!--row-->
</div><!--container -->
@endsection
@section('page_scripts')
<script>  
 $( document ).ready(function() {
    //ADD MORE
    var i=1;  
    // $('#add').click(function(){  
    //     i++; 
    //     var lang=$('#add').attr('rel');
    //     alert(); 
    //     $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="answer[]" placeholder="Enter answer here" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">Remove</button></td></tr>');  
    // });  

    // $(document).on('click', '.btn_remove', function(){  
    //        var button_id = $(this).attr("id");   
    //        $('#row'+button_id+'').remove();  
    //   });  

    $("#add1").click(function(){
   
   ++i;

        $("#dynamicTable1").append('<tr><td><input type="text"  id="sel_lang[1]" name="enganswer[]" placeholder="Enter answer in English" class="form-control" /></td><td><input type="text"  id="sel_lang[2]" name="malanswer[]" placeholder="Enter answer in malayalam" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
        });

        $(document).on('click', '.remove-tr', function(){  
            $(this).parents('tr').remove();
        }); 

    var edit=$('#edit_id').val();
    // alert(edit);
    if(edit=='E')
    {
        var hidden_id =$('.poster').attr('rel');
        // alert(hidden_id);
        // $('#datatable_div').hide();
        var value = '#preview-image-before-upload'+hidden_id;
        // alert(value);
        $('.preview_poster').show();    
            let reader = new FileReader();
         
            reader.onload = (e) => { 
         
              $(value).attr('src', e.target.result); 
            }

            // reader.readAsDataURL(this.files[0]); 
            // $(".poster")[0].reset();
        $('.preview_poster').show();
    }else{
//  $('.card-main').show();
    }


});


</script>
@endsection
