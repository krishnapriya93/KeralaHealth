@extends('backend.layouts.htmlheader')
<style>
  .btn-sm-default {
    font-size: 12px; /* Adjust size */
    padding: 0.25rem 0.5rem; /* Adjust padding */
}

</style>
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
                <div class="card-header text-white card-header-main">{{ __('List of Suggestion') }}</div>
                <div class="row"><div class="col-sm-9"></div><div class="col-sm-3 mt-3"><a href="{{route('officer.createsuggestion')}}" id="addlogobtn" class="btn btn-flat btn-point btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;Add New Record</a></div> </div>

                <div class="card-body">
                    <table id="datatable_view" class="table table-striped">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Type</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i=0;
                    @endphp

                    @foreach ($data as $key => $result)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                                        @switch($result->typeId)
                                            @case(0)
                                                <span class="badge bg-info">Suggestion</span>
                                                @break
                                            @case(1)
                                                <span class="badge bg-primary">Announcement</span>
                                                @break
                                            @case(2)
                                                <span class="badge bg-warning">What's New</span>
                                                @break
                                            @case(3)
                                                <span class="badge bg-success">Awards</span>
                                                @break
                                            @case(4)
                                                <span class="badge bg-secondary">Initiatives</span>
                                                @break
                                            @case(5)
                                                <span class="badge bg-dark">Overview</span>
                                                @break
                                            @case(6)
                                                <span class="badge bg-light text-dark">Wellness Tip</span>
                                                @break
                                            @case(7)
                                                <span class="badge bg-danger">Projects</span>
                                                @break
                                            @case(8)
                                                <span class="badge bg-danger">Banner</span>  
                                                @break
                                            @case(9)
                                                <span class="badge bg-danger">MIS</span>  
                                                @break   
                                            @case(10)
                                                <span class="badge bg-danger">About Department</span>  
                                                @break        
                                            @case(11)
                                                <span class="badge bg-danger">Publication</span>  
                                                @break    
                                            @case(12)
                                                <span class="badge bg-danger">Dashboard</span>  
                                                @break   
                                            @case(13)
                                                <span class="badge bg-danger">Sustainable Development Goals</span>  
                                                @break   
                                            @case(14)
                                                <span class="badge bg-danger">Emergency Information</span>  
                                                @break  
                                            @case(15)
                                                <span class="badge bg-danger">Health Alerts</span>  
                                                @break   
                                            @case(16)
                                                <span class="badge bg-danger">Grievance Section</span>  
                                                @break                                        
                                            @default
                                                <span class="badge bg-secondary">Unknown</span>
                                        @endswitch
                                    </td>
                        <td>{{$result->title ?? ''}}</td>
                        <td>
                          @if ($result->status_id == 1)
                            <a class="main-btn info-btn rounded-full btn-hover btn-sm-default"
                                                    href="{{ route('officer.statussuggestion', \Crypt::encryptString($result->id)) }}">Active</a>
                          @else
                            <a class="main-btn deactive-btn rounded-full btn-hover btn-sm-default"
                                                    href="{{ route('officer.statussuggestion', \Crypt::encryptString($result->id)) }}">Deactive</a>
                          @endif
                        </td>
                        <td>
                        @if($result->approverstatus ==0)
                        <a class="btn btn-primary btn-sm-default" href="{{ route('officer.editsuggestion',\Crypt::encryptString($result->id)) }}">Edit</a>
                        <!-- <a class="btn btn-danger btn-sm-default" href="{{ route('officer.deletesuggestion',\Crypt::encryptString($result->id)) }}" onclick="return confirm('Are you sure?')">Delete</a> -->
                        @elseif($result->approverstatus==1)
                         <button class="btn btn-success btn-sm-default" data-bs-toggle="modal" data-bs-target="#revertModal" data-message="{{ $result->approverremark }}">
                             Approved
                         </button>
                        @elseif($result->approverstatus==2)
                        <button class="btn btn-danger btn-sm-default" data-bs-toggle="modal" data-bs-target="#revertModal" data-message="{{ $result->approverremark }}">
                        Rejected
                        </button>
                         @elseif($result->approverstatus==3)
                         <button class="btn btn-warning btn-sm-default" data-bs-toggle="modal" data-bs-target="#revertModal" data-message="{{ $result->approverremark }}">
                            Reverted
                        </button>
                         <a class="btn btn-primary btn-sm-default btn-sm-default" href="{{ route('officer.editsuggestion',\Crypt::encryptString($result->id)) }}">Edit</a>
                        @endif
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
        <!-- Modal -->
        <!-- Modal -->
<div class="modal fade" id="revertModal" tabindex="-1" aria-labelledby="revertModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="revertModalLabel">Remark</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <span id="messageContent"></span>  <!-- Message will be shown here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <!-- <button type="button" class="btn btn-warning" id="confirmRevert">Confirm</button> -->
      </div>
    </div>
  </div>
</div>

</div>
@endsection
@section('page_scripts')
<script>
     $( document ).ready(function() {
    $(".alert").fadeTo(2000, 500).slideUp(500, function() {
      $(".alert").slideUp(500);
    });

    $('.alert').alert();
});
// When the modal is about to be shown
$('#revertModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var message = button.data('message'); // Extract the message from data-message attribute
    
    // Set the message inside the modal body
    $('#messageContent').text(message); // Display the message in the modal
    
    // Handle the confirm action (optional)
    $('#confirmRevert').off('click').on('click', function () {
        // You can perform any action here, such as an AJAX request
        
        // Close the modal
        var myModal = new bootstrap.Modal(document.getElementById('revertModal'));
        myModal.hide();
    });
});

</script>
@endsection
