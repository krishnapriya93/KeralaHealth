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
                <div class="card-header text-white card-header-main">{{ __('List of Survey Question') }}</div>
      
                <div class="row"><div class="col-sm-9"></div><div class="col-sm-3 mt-3"><a href="{{route('siteadmin.createpoll')}}" id="addlogobtn" class="btn btn-flat btn-point btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;Add New Record</a></div> </div>
                <div class="card-body">
                    <table id="datatable_view" class="table table-striped">
                    <thead>    
                    <tr>
                        <th>No</th>
                        <th>Question</th>
                        <!-- <th>Answer</th> -->
                        <th>Status</th>
                        <th width="280px">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php 
                    $i=0;
                    @endphp 
                   
                    @foreach ($data as $key => $result)
          
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{$result->Pollquestionsub[0]->question ?? ''}}</td>
                        <!-- <td>{{$result->pollanswers[0]->pollanswersub[0]->answer ?? ''}}</td> -->
                        <td>
                        <a class="btn btn-warning btn-sm-default" href="{{ route('siteadmin.statuspoll',\Crypt::encryptString($result->id)) }}">Status</a> 
                        </td>
                        <td>
                           
                            <a class="btn btn-warning btn-sm-default" href="{{ route('siteadmin.statuspoll',\Crypt::encryptString($result->id)) }}">View</a>
                            <a class="btn btn-danger btn-sm-default" href="{{ route('siteadmin.deletepoll',\Crypt::encryptString($result->id)) }}">Delete</a>
                            <a class="btn btn-success btn-sm-default" href="{{ route('siteadmin.statuspoll',\Crypt::encryptString($result->id)) }}">Result</a>
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
@section('page_scripts')
<script>  
 $( document ).ready(function() {


});
</script>
@endsection
