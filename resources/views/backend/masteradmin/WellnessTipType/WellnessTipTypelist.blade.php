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
                <div class="card-header text-white card-header-main">{{ __('List of Wellness Tip Type') }}</div>

                <div class="row"><div class="col-sm-9"></div><div class="col-sm-3 mt-3"><a href="{{route('masteradmin.createWellnessTipType')}}" id="addlogobtn" class="btn btn-flat btn-point btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;Add New Record</a></div> </div>


                <div class="card-body">
                    <table id="datatable_view" class="table table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i=0;
                    @endphp
                    @foreach ($datas as $key => $result)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$result->wellnessTipTypesub[0]->title ?? ''}}<br>
                            {{$result->wellnessTipTypesub[1]->title ?? ''}}
                        </td>

                        <td>
                            <a class="btn btn-primary btn-sm-default" href="{{ route('masteradmin.editWellnessTipType',\Crypt::encryptString($result->id)) }}">Edit</a>
                            <a class="btn btn-danger btn-sm-default" href="{{ route('masteradmin.deleteWellnessTipType',\Crypt::encryptString($result->id)) }}">Delete</a>
                        </td>
                    </tr>
                     <!-- $i++; -->
                    @endforeach
                    </tbody>
                    </table>

                </div>
            </div> <!--card2 -->

        </div>
    </div>
</div>
@endsection
@include('backend.layouts.commonscript')
<script>
     $( document ).ready(function() {
    $(".alert").fadeTo(2000, 500).slideUp(500, function() {
      $(".alert").slideUp(500);
    });

    $('.alert').alert();
});
</script>
