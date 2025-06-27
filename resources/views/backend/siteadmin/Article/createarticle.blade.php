@extends('backend.layouts.htmlheader')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!!$breadcrumbarr!!}
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 pb-5">
            @if(!isset($editF))
            <!-- <div><a class="btn btn-flat btn-point btn-sm btn-success mb-2" id="addarticle"><i class="fas fa-plus" aria-hidden="true"></i> Add Article</a></div> -->
            @endif
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{Session::get('success')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session('delete'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{Session::get('delete')}}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card" id="entry_div1">
                <div class="card-header text-white card-header-main">{{isset($editF) ? 'Update' : 'Add'}} Article</div>
                <div class="card-body">

                    @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    <input type="hidden" name="EditF" id="EditF" value="{{(isset($editF)) ? 'E':'A'}}">
                    <input type="hidden" name="Errval" id="Errval" value="{{($errors->any()||(session('error'))) ? '1':'2'}}">

                    @if($errors->any())
                    <div class="alert alert-danger" role="alert">

                        {!! implode(' ', $errors->all('<li><span class="text-danger">:message</span></li><br>')) !!}
                    </div> <!-- ./alert -->
                    @endif
                    @if(isset($editF))
                    <form id="formid" method="POST" action="{{ route('updatearticle') }}" enctype="multipart/form-data">
                        @else
                        <form id="formid" method="POST" action="{{ route('storearticle') }}" enctype="multipart/form-data">
                            @endif
                            @csrf
                            <!-- <span class="alert-warning postererr">File type: jpg/jpeg/png, Size: less than 1 MB, dimension: 960px960px (in pixels)</span> -->
                            <input type="hidden" name="hidden_id" value="{{$keydata->id ?? ''}}">
                            <input type="hidden" name="Errval" id="Errval" value="{{($errors->any()||(session('error'))) ? '1':'2'}}">
                            <input type="hidden" id="edit_id" name="edit_id" value="{{$edit_f ?? ''}}">
                            <input type="hidden" id="sbu_view_edit" name="sbu_view_edit" value="{{$keydata->viewer_id ?? ''}}">
                            <input type="hidden" id="departId" name="departId" value="{{$dataEdit->officeId ?? ''}}">
                            <input type="hidden" id="articletype_id" name="articletype_id" value="{{$dataEdit->articletype_id ?? ''}}">
                            <div class="row mb-3 card-header card-main">

                                @php
                                $i=0;
                                $lanC=1;
                                $langval='';
                                @endphp
                                @if(isset($editF))
                                <div class="row div_lan1 mb-3">
                                    <div class="col-sm-6 mb-btm">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Article Type</label>
                                            <select class="form-control" id="articleType" name="articleType" required>
                                                <option>Select Article Type</option>

                                                @foreach($arttype as $atype)

                                                @foreach($atype->articletype_sub as $artsub)
                                                <option @if($dataEdit->articletype_id==$atype->id) selected @endif value="{{\Crypt::encryptString($atype->id)}}" >{{$artsub->title}}</option>
                                                @endforeach

                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- <div class="col-sm-6 mb-btm div_office">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">Article Type</label>
                                            <select class="form-control" id="articleType" name="articleType" required>
                                                <option>Select Article Type</option>

                                                @foreach($arttype as $atype)

                                                @foreach($atype->articletype_sub as $artsub)
                                                <option @if($dataEdit->articletype_id==$atype->id) selected @endif value="{{\Crypt::encryptString($atype->id)}}" >{{$artsub->title}}</option>
                                                @endforeach

                                                @endforeach
                                            </select>
                                        </div>
                                    </div> -->
                                    <!-- Office code start -->




                                    @if(isset($dataEdit) && in_array($dataEdit->articletype_id, [8, 9, 10,11, 13, 14,18,25,26]))

                                    @php

                                    $officeArray = explode(',', $dataEdit->officeId);

                                    @endphp

                                    <div class="col-sm-4 mb-btm div_office">
                                        <div class="form-group">
                                            <label for="office" class="form-label">Select Office_</label>
                                            <select class="form-control form-select select2" name="office[]" id="office" multiple>
                                                @foreach($officeArray as $officeVal)
                                                @foreach ($offices as $office)

                                                <option @if($officeVal==$office->id) selected @endif value="{{ $office->id }}" >{{ $office->office_sub[0]->title }}</option>

                                                @endforeach
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    @if(isset($dataEdit->submenu))
                                    @php
                                    // Find submenu by ID
                                    $submenu = $depsubmenus->firstWhere('id', $dataEdit->submenu);
                                    @endphp

                                    <div class="form-check mt-2">
                                        <input class="form-check-input" type="radio" name="office_radio" id="office_radio_{{ $submenu->id ?? 'unknown' }}" value="{{ $submenu->id ?? '' }}" checked>
                                        <label class="form-check-label" for="office_radio_{{ $submenu->id ?? 'unknown' }}">
                                            {{ $submenu->dep_submenu[0]->title ?? 'Submenu not found' }}
                                        </label>
                                    </div>

                                    @endif
                                    @endif

                                    <!-- Office code start -->
                                </div>

                                <!-- edit -->
                                @foreach($language as $langs)
                                @if(isset($dataEdit->articleval_sub[$i]->languageid))
                                @php $langval=$dataEdit->articleval_sub[$i]->languageid; @endphp
                                @else
                                @php $langval=$langval; @endphp
                                @endif
                                @if($lanC==$langval)
                                <div class="col-sm-12 card-header card-custom-header bg-secondary text-white mb-3"><label for="path" class="col-sm-2 col-form-label">{{$langs->name}}</label></div><br />
                                <div class="row div_lan1 mb-3">
                                    <div class="col-sm-6 mb-btm" id="div{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Main Title in {{$langs->name}} <span class="redalert"> *</span></label>
                                        <input id="title{{$langs->id}}" type="text" class="form-control title @error('title') is-invalid @enderror" name="title[]" value="{{ $dataEdit->articleval_sub[$i]->title ?? old('title.'.$i)}}" required autocomplete="title" placeholder="Enter main {{$langs->name}} here" autofocus>
                                        <span class="title_validation redalert titleerr1 display_status">Please Check the Entered</span>
                                    </div><br />

                                    <div class="col-sm-6 mb-btm" id="div_sub{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Sub title in {{$langs->name}} </label>
                                        <input id="sub_title{{$langs->id}}" type="text" class="form-control @error('sub_title') is-invalid @enderror" name="sub_title[]" value="{{ $dataEdit->articleval_sub[$i]->subtitle ?? old('sub_title.'.$i)}}" autocomplete="sub_title" placeholder="Enter sub {{$langs->name}} here" autofocus>
                                    </div><br />

                                </div><br>
                                <div class="row div_lan1 mb-3">

                                    <div class="col-sm-12 mb-btm" id="div_content{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Content in {{$langs->name}} <span class="redalert"> *</span></label>
                                        <textarea id="con_title[{{$langs->id}}]" class="form-control ckeditorarticle @error('con_title') is-invalid @enderror" name="con_title[{{$langs->id}}]" required autocomplete="language" placeholder="Enter Content in {{$langs->name}} here" autofocus>
                                        {{ $dataEdit->articleval_sub[$i]->content ?? old('con_title.'.$i)}}
                                        </textarea>
                                    </div><br />
                                </div>
                                <div class="row div_lan1 mb-3">
                                    @if(Auth::user()->role_id==11)

                                    @else
                                    <div class="col-sm-3 mb-btm" id="div_poster{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">{{$langs->name}} Poster</label>
                                        <input id="poster{{$langs->id}}" type="file" class="form-control @error('poster') is-invalid @enderror" name="poster[]" value="{{ $dataEdit->articleval_sub[$i]->poster ?? old('poster.'.$i)}}" autocomplete="language" placeholder="Enter main {{$langs->name}} here" autofocus>
                                        <span class="alert-warning postererr{{$langs->id}}">File type: jpg/jpeg/png, Size: less than 1 MB, dimension: 960px960px (in pixels)</span>
                                    </div><br />
                                    <div class="col-sm-3 mb-btm" id="div_poster{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> <span class="redalert"> </span></label>
                                        @if(isset($dataEdit->articleval_sub[$i]->file)) <img src="{{asset('/assets/backend/uploads/articles/'.$dataEdit->articleval_sub[$i]->file)}}" class="imgstamp preview-image-before-upload">@endif
                                    </div><br />
                                    @endif

                                    <div class="col-sm-6 mb-btm" id="div_alt{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Alternative title in {{$langs->name}} <span class="redalert"> *</span></label>
                                        <input id="alt_title{{$langs->id}}" type="text" class="form-control alt_title @error('alt_title') is-invalid @enderror" name="alt_title[]" value="{{ $dataEdit->articleval_sub[$i]->alt ?? old('alt_title.'.$i)}}" required autocomplete="language" placeholder="Enter Alternative {{$langs->name}} here" autofocus readonly>
                                    </div><br />
                                </div>
                                <!-- <div class="row div_lan1 mb-3">
                                <div class="col-sm-12 mb-btm" id="div_tags{{$langs->id}}"> 
                                    <div class="form-group">
                                            <label for="exampleFormControlSelect2">Tags in {{$langs->name}}</label>
                                            <select multiple="multiple" class="form-control select2 selecttag" id="tags_id{{$langs->id}}" name="tags_id[]">
                                                
                                                @php 
                                                    $k=1;
                                                @endphp
                                                @foreach($keywordtags as $keytag)
                                                    @foreach($keytag->keytag_sub as $tagg)
                                                        @if($k==$langs->id)
                                                            <option @if($dataEdit->articleval_sub[$i]->tags_id==$keytag->id)}} selected @endif value="{{\Crypt::encryptString($keytag->id)}}">{{$tagg->title}}</option>
                                                        @endif
                                                        @php 
                                                    $k++;
                                                @endphp
                                                    @endforeach
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                            </div> -->
                                <div class="row div_lan1 mb-3">
                                    <div class="col-sm-12 mb-btm" id="div_tags{{ $langs->id }}">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">E Tags in {{ $langs->name }}</label>
                                            <select multiple="multiple" class="form-control select2 selecttag" id="tags_id{{ $langs->id }}" name="tags_id[{{ $langs->id }}][]">
                                                <!-- Only the first tag is selected initially -->
                                                @foreach($keywordtags as $keytag)
                                                @foreach($keytag->keytag_sub as $tagg)
                                                @if($tagg->languageid == $langs->id)
                                                <option @if($dataEdit->articleval_sub[$i]->tags_id==$keytag->id) selected @endif value="{{$keytag->id}}">{{$tagg->title}}</option>
                                                <!-- <option value="{{ \Crypt::encryptString($keytag->id) }}" {{ $loop->first ? 'selected' : '' }}> -->
                                                {{ $tagg->title }}
                                                </option>
                                                @endif
                                                @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-sm-12 card-header card-custom-header bg-secondary text-white mb-3"><label for="path" class="col-sm-2 col-form-label">{{$langs->name}}</label></div><br />
                                <div class="row div_lan1 mb-3">
                                    <div class="col-sm-6 mb-btm" id="div{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Main Title in {{$langs->name}} <span class="redalert"> *</span></label>
                                        <input id="title{{$langs->id}}" type="text" class="form-control title @error('title') is-invalid @enderror" name="title[]" value="{{ $dataEdit->articleval_sub[$i]->title ?? old('title.'.$i)}}" required autocomplete="title" placeholder="Enter main {{$langs->name}} here" autofocus>
                                    </div><br />

                                    <div class="col-sm-6 mb-btm" id="div_sub{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Sub title in {{$langs->name}}</label>
                                        <input id="sub_title{{$langs->id}}" type="text" class="form-control @error('sub_title') is-invalid @enderror" name="sub_title[]" value="{{ $dataEdit->articleval_sub[$i]->subtitle ?? old('sub_title.'.$i)}}" autocomplete="sub_title" placeholder="Enter sub {{$langs->name}} here" autofocus>
                                    </div><br />

                                </div><br>
                                <div class="row div_lan1 mb-3">

                                    <div class="col-sm-12 mb-btm" id="div_content{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Content in {{$langs->name}} <span class="redalert"> *</span></label>
                                        <textarea id="con_title[{{$langs->id}}]" value=" {{ $dataEdit->articleval_sub[$i]->content ?? old('con_title.'.$i)}}" class="form-control ckeditor12 @error('con_title') is-invalid @enderror" name="con_title[]" required autocomplete="language" placeholder="Enter Content in {{$langs->name}} here" autofocus>
                                        {{ $dataEdit->articleval_sub[$i]->content ?? old('con_title.'.$i)}}
                                        </textarea>
                                    </div><br />
                                </div>
                                <div class="row div_lan1 mb-3">
                                    @if(Auth::user()->role_id==11)

                                    @else
                                    <div class="col-sm-3 mb-btm" id="div_poster{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">{{$langs->name}} Poster </label>
                                        <input id="poster{{$langs->id}}" type="file" class="form-control @error('poster') is-invalid @enderror poster" name="poster[]" rel="{{$langs->id}}" value="{{ $dataEdit->articleval_sub[$i]->poster ?? old('poster.'.$i)}}" autocomplete="language" placeholder="Enter main {{$langs->name}} here" autofocus>
                                        <span class="alert-warning postererr{{$langs->id}}">File type: jpg/jpeg/png, Size: less than 1 MB, dimension: 960px960px (in pixels)</span>
                                        <!-- <span class="article-poster-img  postererr_dis{{$langs->id}}">Note: for better design resolution ,File type: jpg/jpeg/png, Size: less than 1 MB, dimension: 960px960px (in pixels)</span> -->
                                    </div><br />
                                    <div class="col-sm-3 mb-btm" id="div_poster{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"> <span class="redalert"> </span></label>
                                        <img id="preview-image-before-upload{{$langs->id}}" rel="{{$langs->id}}" class="preview-image-before-upload imgstamp" src="" alt="preview image">
                                    </div><br />
                                    @endif

                                    <div class="col-sm-6 mb-btm" id="div_alt{{$langs->id}}">
                                        <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Alternative title in {{$langs->name}} <span class="redalert"> *</span></label>
                                        <input id="alt_title{{$langs->id}}" type="text" class="form-control alt_title @error('alt_title') is-invalid @enderror" name="alt_title[]" value="{{ $dataEdit->articleval_sub[$i]->alt ?? old('alt_title.'.$i)}}" required autocomplete="language" placeholder="Enter Alternative {{$langs->name}} here" autofocus readonly>
                                    </div><br />
                                </div>


                                <div class="row div_lan1 mb-3">
                                    <div class="col-sm-12 mb-btm" id="div_tags{{ $langs->id }}">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect2">C Tags in {{ $langs->name }}</label>
                                            <select multiple="multiple" class="form-control select2 selecttag" id="tags_id{{ $langs->id }}" name="tags_id[]">
                                                <!-- Only the first tag is selected initially -->
                                                @foreach($keywordtags as $keytag)
                                                @foreach($keytag->keytag_sub as $tagg)
                                                @if($tagg->languageid == $langs->id)
                                                <option value="{{ $keytag->id }}" {{ $loop->first ? 'selected' : '' }}>
                                                    {{ $tagg->title }}
                                                </option>
                                                @endif
                                                @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                @php
                                $i++;
                                $lanC++;
                                @endphp

                                @endforeach


                            </div>

                            <!-- edit -->
                            @else
                            <!-- add -->
                            <div class="row div_lan1 mb-3">
                                <div class="col-sm-6 mb-btm">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2">Article Type</label>
                                        <select class="form-control" id="articleType" name="articleType" required>
                                            <option selected>Select Article Type</option>
                                            @foreach($arttype as $atype)

                                            @foreach($atype->articletype_sub as $artsub)
                                            <option value="{{\Crypt::encryptString($atype->id)}}">{{$artsub->title}}</option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Office code start -->
                                <div class="col-sm-6 mb-btm div_office">
                                    <div class="form-group">
                                        <label for="office" class="form-label">Select Office</label>
                                        <select class="form-control form-select select2" name="office[]" id="office" multiple>
                                            @foreach ($offices as $office)
                                            <option value="{{ $office->id }}"
                                                {{ in_array($office->id, request('office', [])) ? 'selected' : '' }}>
                                                {{ $office->office_sub[0]->title }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- Office code start -->

                            </div>
                            <div class="alert alert-primary div_officedetails" role="alert">
                                A simple primary alert—check it out!
                                <input type="hidden" name="office_id" id="office_id" value="">
                                <input type="hidden" name="submenu_id" id="submenu_id" value="">
                            </div>

                            @foreach($language as $langs)
                            <div class="col-sm-12 card-header card-custom-header bg-secondary text-white mb-3"><label for="path" class="col-sm-2 col-form-label">{{$langs->name}}</label></div><br />
                            <div class="row div_lan1 mb-3">
                                <div class="col-sm-6 mb-btm" id="div{{$langs->id}}">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Main Title in {{$langs->name}} <span class="redalert"> *</span></label>
                                    <input id="title{{$langs->id}}" type="text" class="form-control title @error('title') is-invalid @enderror" name="title[]" value="{{ $keydata->title ?? old('title.'.$i)}}" required autocomplete="title" placeholder="Enter main {{$langs->name}} here" autofocus>
                                    <span id="uniqueCheckResult"></span>
                                </div><br />


                                <div class="col-sm-6 mb-btm" id="div_sub{{$langs->id}}">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Sub title in {{$langs->name}} </label>
                                    <input id="sub_title{{$langs->id}}" type="text" class="form-control @error('sub_title') is-invalid @enderror" name="sub_title[]" value="{{ $keydata->sub_title ?? old('sub_title.'.$i)}}" autocomplete="sub_title" placeholder="Enter sub {{$langs->name}} here" autofocus>
                                </div><br />

                            </div><br>
                            <div class="row div_lan1 mb-3">

                                <div class="col-sm-12 mb-btm" id="div_content{{$langs->id}}">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Content in {{$langs->name}} <span class="redalert"> *</span></label>
                                    {{$langs->name}} <textarea id="con_title[{{$langs->id}}]" class="form-control ckeditor12 @error('con_title') is-invalid @enderror" name="con_title[{{$langs->id}}]" value="{{ $keydata->title ?? old('con_title.'.$i)}}" required autocomplete="language" placeholder="Enter Content in {{$langs->name}} here" autofocus></textarea>
                                </div><br />
                            </div>
                            <div class="row div_lan1 mb-3">
                                @if(Auth::user()->role_id==11)
                                @else
                                <div class="col-sm-6 mb-btm" id="div_poster{{$langs->id}}">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">{{$langs->name}} Poster </label>
                                    <input id="poster{{$langs->id}}" type="file" rel="{{$langs->id}}" class="form-control @error('poster') is-invalid @enderror poster" name="poster[]" value="{{ $keydata->poster ?? old('poster.'.$i)}}" autocomplete="language" placeholder="Enter main {{$langs->name}} here" autofocus>
                                    <span class="alert-warning postererr{{$langs->id}}">File type: jpg/jpeg/png, Size: less than 1 MB, dimension: 960px960px (in pixels)</span>
                                    <!-- <span class="article-poster-img  postererr_dis{{$langs->id}}">Note: for better design resolution ,File type: jpg/jpeg/png, Size: less than 1 MB, dimension: 960px960px (in pixels)</span> -->
                                </div><br />



                                @endif
                                <div class="col-sm-6 mb-btm" id="div_alt{{$langs->id}}">
                                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Alternative title in {{$langs->name}} <span class="redalert"> *</span></label>
                                    <input id="alt_title{{$langs->id}}" type="text" class="form-control alt_title @error('alt_title') is-invalid @enderror" name="alt_title[]" value="{{ $keydata->title ?? old('alt_title.'.$i)}}" required autocomplete="language" placeholder="Enter Alternative {{$langs->name}} here" autofocus readonly>
                                    <span id="uniqueCheckResult"></span>
                                </div><br />
                            </div>
                            <!-- <div class="row div_lan1 mb-3">
                                <div class="col-sm-12 mb-btm" id="div_tags{{$langs->id}}"> 
                                    <div class="form-group">
                                            <label for="exampleFormControlSelect2">Tags in {{$langs->name}}</label>
                                            <select multiple="multiple" class="form-control select2 selecttag" id="tags_id{{$langs->id}}" name="tags_id[]">
                                                
                                                @php 
                                                    $k=1;
                                                @endphp
                                                @foreach($keywordtags as $keytag)
                                                    @foreach($keytag->keytag_sub as $tagg)
                                                        @if($k==$langs->id)
                                                            <option selected value="{{\Crypt::encryptString($keytag->id)}}">{{$tagg->title}}</option>
                                                        @endif
                                                        @php 
                                                    $k++;
                                                @endphp
                                                    @endforeach
                                                @endforeach
                                            </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row div_lan1 mb-3">
                                <div class="col-sm-12 mb-btm" id="div_tags{{ $langs->id }}">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect2">Create Tags in {{ $langs->name }}</label>
                                        <select multiple="multiple" class="form-control select2 selecttag" id="tags_id{{ $langs->id }}" name="tags_id[{{ $langs->id }}][]>
                                            @foreach($keywordtags as $keytag)
                                                @foreach($keytag->keytag_sub as $tagg)
                                                    @if($tagg->languageid == $langs->id)
                                                        <option value=" {{ $keytag->id }}" {{ $loop->first ? 'selected' : '' }}>
                                            {{ $tagg->title }}
                                            </option>
                                            @endif
                                            @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>



                </div>

                @php
                $i++;
                @endphp
                @endforeach
               

            </div>

        </div>
        @endif
        
        <div class="row px-2 mt-2">

<div class="col-sm-12" id="div_service_url">
    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">URL </label>
    <input id="service_url" type="url" class="form-control service_url @error('service_url') is-invalid @enderror" name="service_url" value="{{ $dataEdit->service_url ?? old('service_url')}}" autocomplete="language" placeholder="Enter Service URL" autofocus>
    <span id="service_url"></span>
</div><br />
</div>

<div class="row px-4 mt-2 me-5 mb-2 ">
<!-- ✅ Single Article Checkbox -->
<div class="form-check mt-0">
    <input type="checkbox" class="form-check-input" name="front_view_flag"
        id="front_view_flag"
        value="1"
        {{ old('front_view_flag', $dataEdit->front_view_flag ?? 0) ? 'checked' : '' }}>

    <label class="form-check-label" for="front_view_flag">
        Department page view flag 
    </label>
</div>
</div>
        <div class="row mb-1">
            <div class="col-sm-10 offset-sm-2">
                @if(isset($editF))
                <input type="hidden" name="EditId" value="{{\Crypt::encryptString($dataEdit->id)}}">
                <button type="submit" class="btn btn-warning btnsbmt">Update</button>
                @else
                <button type="submit" class="btn btn-primary btnsbmt">Add </button>
                @endif
            </div>
        </div>
    </div><!-- .row -->
    </form>
</div><!-- .card-body -->
</div><!-- .card -->


</div><!-- .row -->
</div><!-- .container -->
@endsection
@section('page_scripts')
<script>
    // function loadEditor(id)
    // {
    //     var instance = CKEDITOR.instances[id];
    //     if(instance)
    //     {
    //         CKEDITOR.remove(instance);
    //     }
    //     CKEDITOR.replace(id);
    // }
    $(document).ready(function() {
        $(document).ready(function() {
            // $('.div_office').hide();
            $('.div_officedetails').hide();
            // $('.office').hide();
            $('#office').select2({
                placeholder: "Select Office",
                allowClear: true
            });
        });
        $('#office').on('change', function(e) {
            $('.div_officedetails').show(); // Show the details div
            var officeId = $(this).val(); // Get the selected office ID

            if (officeId) {
                $.ajax({
                    url: "{{ route('siteadmin.getofficedetails') }}", // Replace with your actual Laravel route
                    type: 'GET', // or 'POST' if sending data
                    data: {
                        office_id: officeId
                    },
                    success: function(response) {
                        // Process the response and update the UI
                        // console.log(response);
                        $('.div_officedetails').html(response); // Update the div with fetched data
                        $('#office_id').val(officeId);

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });

        // CKEDITOR.replace( 'con_title' );
        $('.div_office').hide();
        $('#articleType').on('click', function(e) {
            var articleType = $('#articleType').val();

            if (articleType !== '') {
                // alert(articleType);
                // Send value to Laravel for encryption
                $.ajax({
                    url: "{{ route('siteadmin.articleidencrypt') }}",
                    type: "Get",
                    data: {
                        articleType: articleType,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log("Encrypted ID:", response.encryptedId);
                        // Debugging

                        //    if ([8, 9, 10, 11].includes(response.encryptedId)) {
                        //         $('.div_office').show();  // Show button after encryption
                        //     } else {
                        //         $('.div_office').hide();  // Hide button after encryption
                        //     }

                        if (8 == response.encryptedId) {
                            $('.div_office').show(); // Show button after encryption
                        } else if (9 == response.encryptedId) {
                            $('.div_office').show(); // Show button after encryption
                        } else if (10 == response.encryptedId) {
                            $('.div_office').show(); // Show button after encryption
                        } else if (11 == response.encryptedId) {
                            $('.div_office').show(); // Show button after encryption
                        } else if (13 == response.encryptedId) {
                            $('.div_office').show(); // Show button after encryption
                        } else if (14 == response.encryptedId) {
                            $('.div_office').show(); // Show button after encryption
                        } else if (18 == response.encryptedId) {
                            $('.div_office').show(); // Show button after encryption
                        } else if (25 == response.encryptedId) {
                            $('.div_office').show(); // Show button after encryption
                        } else if (26 == response.encryptedId) {
                            $('.div_office').show(); // Show button after encryption
                        } else {
                            $('.div_office').hide(); // Hide button after encryption
                        }


                    },
                    error: function(xhr) {
                        console.error("Encryption failed:", xhr.responseJSON);
                        $('#submitButton').hide(); // Hide button if encryption fails
                    }
                });
            } else {
                $('#submitButton').hide(); // Hide button if input is empty
            }
        });



        // alert("dfdfdf");

        // $('#btn').click(function(){
        //     CKEDITOR.instances.con_title.updateElement();
        // }); 
        $(".selecttag").select2({
            width: '100%',
            placeholder: "Select multiple tags",
            allowClear: true,
            minimumResultsForSearch: Infinity // Hide the search box for better UX
        });


        if ($('#EditF').val() == 'E') {
            $("#entry_div").show();
            var articletype_id = $("#articletype_id").val();

            if ([8, 9, 10, 11, 13, 14, 18, 25, 26].includes(parseInt(articletype_id))) {
                // alert(articletype_id);
                $('.div_office').show(); // Show button after encryption

            } else {

                $('.div_office').hide(); // Hide if not in the list
            }


        } else {
            if ($('#Errval').val() != 1 && $('#EditF').val() != 'E') {
                $("#entry_div").hide();
            }
        }
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
        $('#addarticle').on('click', function(e) {
            if ($('#entry_div').css('display') == 'none') {
                $('#entry_div').show();
            } else {
                $('#entry_div').hide();
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
        var edit = $('#edit_f').val();
        $('.postererr1').hide();
        $('.postererr2').hide();

        if (edit == 'E') {
            var hidden_id = $('.radioval').val();
            $('#datatable_div').hide();
            var value = '#preview-image-before-upload' + hidden_id;
            // alert(value);
            $('.preview_poster').show();
            let reader = new FileReader();

            reader.onload = (e) => {

                $(value).attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            // $(".poster")[0].reset();
            $('.preview_poster').show();
        } else {

            $('.preview_poster').hide();
        }
        //poster view
        $('.poster').change(function() {

            var i = $(this).attr('rel');

            var value = '#preview-image-before-upload' + i;
            //    alert(value);
            $('.preview_poster').show();
            let reader = new FileReader();

            reader.onload = (e) => {

                $(value).attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
            // $(".poster")[0].reset();
        });
        //Restricted
        $("#restricted").click(function() {
            $(".usertype_div").show();
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
        $('#title1').on('keyup', function(e) {

            var ttitleVal = $(this).val().replace(/\s+/g, '_');
            $('#alt_title1').val(ttitleVal);

        });

        $('#title2').on('keyup', function(e) {

            var ttitleVal = $(this).val().replace(/\s+/g, '_');
            $('#alt_title2').val(ttitleVal);

        });

        $('.title').on('change', function() {
            var title = $(this).val();

            var resultSpan = $('#uniqueCheckResult');

            // Send AJAX request to check uniqueness
            $.ajax({
                url: '{{ route('siteadmin.article_check_title_unique') }}', // Route to handle the uniqueness check
                method: 'POST',
                data: {
                    title: title,
                    _token: '{{ csrf_token() }}' // Include CSRF token
                },
                success: function(response) {
                    // console.log(response)
                    if (response.unique) {
                        resultSpan.text('Title is unique').css('color', 'green');
                        $('.btnsbmt').prop('disabled', false); // Enables the button
                    } else {
                        resultSpan.text('Title already exists').css('color', 'red');
                        $('.btnsbmt').prop('disabled', true); // Disables the button

                    }
                }
            });
        });

        // $(".alert").fadeTo(5000, 5000).slideUp(5000, function() {
        //     $(".alert").slideUp(10000);
        // });

        // $('.alert').alert();
    });

    // $('#office').on('change', function () {
    //     let selectedOfficeIds = $(this).val(); // array of selected office IDs
    //     console.log("Selected Office IDs:", selectedOfficeIds);

    //     $.ajax({
    //         url: "{{ route('siteadmin.depsubmenus') }}", // your Laravel route
    //         type: "POST",
    //         data: {
    //             _token: '{{ csrf_token() }}',
    //             office_ids: selectedOfficeIds
    //         },
    //         success: function (response) {
    //             console.log("AJAX Response:", response);
    //             // Handle the response, e.g., populate another dropdown
    //             // Example: $('#subdivision').html(response.options);
    //         },
    //         error: function (xhr) {
    //             console.error("AJAX Error:", xhr.responseText);
    //         }
    //     });
    // });

    $(document).on('change', 'input[name="officesubmenu"]', function() {
        var officeId = $(this).val();
        console.log(officeId);

        // Remove previous dropdowns
        $('.dropdown-container').hide().html('');

        // Find the related dropdown container
        var $row = $(this).closest('tr');
        var $dropdownContainer = $row.find('.dropdown-container');

        if (officeId) {
            $.ajax({
                url: "{{ route('siteadmin.depsubmenus') }}",
                type: 'GET',
                data: {
                    office_id: officeId
                },
                success: function(response) {
                    console.log(response);
                    // $dropdownContainer.html(response.html).show();
                    $dropdownContainer.html(response).show();
                    $dropdownContainer.find('.select2').select2(); // Apply select2 to the new select

                },
                error: function() {
                    $dropdownContainer.html('<span class="text-danger">Error loading data.</span>').show();
                }
            });
        }
    });
</script>
@endsection