@extends('layouts.htmlheader')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!!$breadcrumbarr!!}
    </ol>
</nav> 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>   {{Session::get('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if(session('delete'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Success!</strong>   {{Session::get('delete')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="card">
                <div class="card-header text-white card-header-main">{{ __('List of Poll Question') }}</div>
      
            </div>

        </div>
    </div>
</div>
@endsection
@section('mainscript')
<script>  
 $( document ).ready(function() {


});
</script>
@endsection
@include('layouts.commonscript')