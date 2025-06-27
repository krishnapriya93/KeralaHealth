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
                <strong>Success!</strong> {{Session::get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session('delete'))
            <div class="alert alert-warning" role="alert">
                {{ session('delete') }}
                <strong>Success!</strong> {{Session::get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card @if($errors->any()) @else  @endif" id="entry_div">
                <div class="card-header text-white card-header-main">{{isset($edit_f) ? 'Update' : 'Add'}} Your Suggestion</div>
                <div class="card-body">
               
                    <input type="hidden" name="Errval" value="{{($errors->any()) ? '1':'2'}}">
                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">

                        {!! implode(' ', $errors->all('<span class="text-danger">:message</span>')) !!}
                    </div> <!-- ./alert -->
                    @endif

                    @if(isset($edit_f))
                    <form id="formid" method="POST" action="{{ route('officer.updatesuggestion') }}" enctype="multipart/form-data">
                        @else
                        <form id="formid" method="POST" action="{{ route('officer.storesuggestion') }}" enctype="multipart/form-data">
                            @endif


                            @csrf
                            <input type="hidden" name="hidden_id" value="{{$keydata->id ?? ''}}">
                            <input type="hidden" name="role_id" id="role_id" value="{{ Auth::user()->id}}">

                            <div class="row">
                                @php $i=0; @endphp
                                <div class="row div_lan1 mb-3">
                                    <div class="col-sm-6 mb-btm">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Type</label>
                                            <select class="form-control select2" id="typeId" name="typeId" required>
                                                <option selected>Select Type</option>
                                                <option value="0" @if(isset($edit_f) && $keydata->typeId == 0) selected @endif>Suggestion</option>
                                                <option value="1" @if(isset($edit_f) && $keydata->typeId == 1) selected @endif>Announcement</option>
                                                <option value="2" @if(isset($edit_f) && $keydata->typeId == 2) selected @endif>Whats new</option>
                                                <option value="3" @if(isset($edit_f) && $keydata->typeId == 3) selected @endif>Awards</option>
                                                <option value="4" @if(isset($edit_f) && $keydata->typeId == 4) selected @endif>Initiatives</option>
                                                <option value="5" @if(isset($edit_f) && $keydata->typeId == 5) selected @endif>Over view</option>
                                                <option value="6" @if(isset($edit_f) && $keydata->typeId == 6) selected @endif>Wellness Tip</option>
                                                <option value="7" @if(isset($edit_f) && $keydata->typeId == 7) selected @endif>Projects</option>
                                                <option value="8" @if(isset($edit_f) && $keydata->typeId == 8) selected @endif>Banner</option>
                                                <option value="9" @if(isset($edit_f) && $keydata->typeId == 9) selected @endif>MIS</option>
                                                <option value="10" @if(isset($edit_f) && $keydata->typeId == 10) selected @endif>About Department</option>
                                                <option value="11" @if(isset($edit_f) && $keydata->typeId == 11) selected @endif>Publication</option>
                                                <option value="12" @if(isset($edit_f) && $keydata->typeId == 12) selected @endif>Dashboard</option>
                                                <option value="13" @if(isset($edit_f) && $keydata->typeId == 13) selected @endif>Sustainable Development Goals</option>
                                                <option value="14" @if(isset($edit_f) && $keydata->typeId == 14) selected @endif>Emergency Information</option>
                                                <option value="15" @if(isset($edit_f) && $keydata->typeId == 15) selected @endif>Health Alerts</option>
                                                <option value="15" @if(isset($edit_f) && $keydata->typeId == 15) selected @endif>Grievance Section
                                                </option>
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>

                                @if(isset($edit_f))
                                <input type="hidden" value="{{$edit_f}}" id="edit_f" name="edit_f">

                                <div class="row div_lan1 mb-3">
                                    <div class="col-sm-6 mb-btm" id="div">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Subject <span class="redalert"> *</span></label>
                                        <input id="title" type="text" class="form-control title title_validation @error('title') is-invalid @enderror" name="subject" value="{{ $keydata->title ?? old('title')}}" required autocomplete="title" placeholder="Enter main  here" autofocus>
                                        <span class="ErrP redalert titleerr1 display_status">Please Check the title Entered</span>
                                        <span class="ErrP redalert titleerr2 display_status">Please Check the title Entered</span>
                                    </div><br />

                                </div><br><!--row end--->

                                <div class="row mb-3">

                                    <div class="col-sm-12 mb-btm" id="div_alt">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Description<span class="redalert"> *</span></label>
                                        <textarea id="description" type="text" class="form-control ckeditor1 @error('description') is-invalid @enderror" name="description" value="{{ $keydata->suggestion ?? old('description')}}" autocomplete="language" placeholder="Enter Alternative  here" autofocus required>{{$keydata->suggestion}}</textarea>
                                        <span class="ErrP redalert titleerr5 display_status">Please Check the title Entered</span>
                                        <span class="ErrP redalert titleerr6 display_status">Please Check the title Entered</span>
                                    </div><br />
                                </div>

                                @else

                                <input type="hidden" value="" id="sel_lang" name="sel_lang[]">
                                <div class="row div_lan1 mb-3">
                                    <div class="col-sm-12 mb-btm" id="div">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Subject <span class="redalert"> *</span></label>
                                        <input id="subject" type="text" class="form-control subject title_validation @error('subject') is-invalid @enderror" name="subject" value="{{ $keydata->subject ?? old('subject')}}" rel="" required autocomplete="subject" placeholder="Enter subject here" autofocus>
                                        <span class="ErrP redalert titleerr1 display_status">Please Check the title Entered</span>
                                        <span class="ErrP redalert titleerr2 display_status">Please Check the title Entered</span>
                                    </div><br />

                                </div><br>

                                <div class="row mb-3">

                                    <div class="col-sm-12 mb-btm" id="div_alt">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Description<span class="redalert"> *</span></label>
                                        <textarea id="description" type="text" class="form-control ckeditor1 @error('description') is-invalid @enderror" name="description" value="{{ $keydata->title ?? old('description')}}" rel="" autocomplete="language" placeholder="Enter Alternative here" autofocus required>{{ $keydata->title ?? old('description')}}</textarea>
                                        <span class="ErrP redalert titleerr5 display_status">Please Check the title Entered</span>
                                        <span class="ErrP redalert titleerr6 display_status">Please Check the title Entered</span>
                                    </div><br />
                                </div>
                                <!-- <div id="file-rows">
                                    <div class="row mb-3">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Upload attachment<span class="redalert"> *</span></label>
                                        <div class="col-md-8">
                                            <input type="file" name="files[]" class="form-control" required>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-success add-row">More attachment</button>
                                        </div>
                                    </div>
                                </div> -->

                                @endif
                                <div></div>

                                <div class="row mb-1">
                                    <div class="col-sm-10 offset-sm-2 text-end">
                                        @if($edit_f ?? '')
                                        <button type="submit" class="btn btn-warning savebtn">Update</button>
                                        @else
                                        <button type="submit" class="btn btn-primary savebtn">Add your suggestion</button>
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

        // Add new row
       
    });

    document.querySelector("form").addEventListener("submit", function (e) {
    let typeId = document.getElementById("typeId");
    if (!typeId.value) {
        alert("Please select a type!");
        e.preventDefault(); // Prevent form submission
    }
});


</script>
@endsection