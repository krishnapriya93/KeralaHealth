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
                <div class="card-header text-white card-header-main">{{isset($edit_f) ? 'Update' : 'Add'}} Menue link type</div>

                <div class="card-body">

                   @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {!! implode(' ', $errors->all('<span class="text-danger">:message</span>')) !!}
                        </div> <!-- ./alert -->
                    @endif

                   @if(isset($edit_f))
                    <form id="formiid" method="POST" action="{{ route('masteradmin.updateMenulinktype') }}" enctype="multipart/form-data">
                    @else
                    <form id="formiid" method="POST" action="{{ route('masteradmin.storemenulinktype') }}" enctype="multipart/form-data">
                    @endif

                    @csrf
                        <input type="hidden" name="hidden_id" value="{{$keydata->id ?? ''}}">

                        <div class="row mb-3">
                            <label for="Menulinktype" class="col-sm-2 col-form-label">Menu link type <span class="redalert"> *</span></label>
                            <div class="col-sm-10">
                            <input id="Menulinktype" type="text" class="form-control @error('Menulinktype') is-invalid @enderror" name="Menulinktype" value="{{ $keydata->name ?? old('Menulinktype')}}" required autocomplete="Menulinktype" placeholder="Enter Menu link type here" autofocus>
                            <span class="ErrP alert-danger Menulinktypeerr redalert" style="display: none;">Please Check the Menu link type Entered</span>
                            <span class="redalert">@error('Menulinktype'){{$message}} @enderror</span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                               @if($edit_f ?? '')
                                <button type="submit" class="btn btn-warning">Update</button>
                               @else
                               <button type="submit" class="btn btn-primary">Add </button>
                               @endif
                               <a type="submit" class="btn btn-success" href="{{route('masteradmin.menulinktype')}}">Refresh</a>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
       <br>
            <div class="card">
                <div class="card-header text-white card-header-main">{{ __('List of menu link type') }}</div>

                <div class="card-body">
                    <table id="datatable_view" class="table table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Language</th>
                        <th>Status</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $key => $result)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$result->name}}</td>
                        <td>
                            @if(($result->status_id)==1)
                            <a class="main-btn info-btn rounded-full btn-hover btn-sm-default" href="{{ route('masteradmin.statusmenutype',\Crypt::encryptString($result->id)) }}">Active</a>
                            @else
                            <a class="main-btn deactive-btn rounded-full btn-hover btn-sm-default" href="{{ route('masteradmin.statusmenutype',\Crypt::encryptString($result->id)) }}">Deactive</a>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('masteradmin.editMenulinktype',\Crypt::encryptString($result->id)) }}">Edit</a>
                            <!-- <a class="btn btn-danger btn-sm" href="{{ route('masteradmin.deleteMenulinktype',\Crypt::encryptString($result->id)) }}">Delete</a> -->
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
@section('mainscript')
<script>
 $( document ).ready(function() {
    // validation in LAng.
    $('#menulinktype').on('keyup', function(e) {
        var testres = engtitle('#menulinktype', this.value);
        alert(testres);
        if (!testres) {
            $('.Menulinktypeerr').text("Not Allowed ");

            $('.Menulinktypeerr').show();

        } else {
            $('.Menulinktypeerr').hide();
        }
     });

});
</script>
@endsection
