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
                <div class="card-header text-white card-header-main">{{ __('List of Suggestion - Report') }}</div>

                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="card p-3">
                            <div class="col-12 my-3">
                                <h5 class="text-primary font-weight-bold">For Advanced Search</h5>
                            </div>
                            
                            <div class="col-md-12">
                                @if(Auth::user()->role_id ==7)
                                <form id="formiid" method="POST" action="{{ route('acs.officewisesearch') }}" enctype="multipart/form-data">
                                    @else
                                    <form id="formiid" method="POST" action="{{ route('editor.officewisesearch') }}" enctype="multipart/form-data">
                                        @endif
                                        @csrf
                                        <!-- First Row: Office, Start Date, End Date -->
                                        <div class="d-flex justify-content-between mb-3">
                                            <!-- Select Office -->
                                            <div class="col-md-3">
                                                <label for="office" class="form-label">Select Office</label>
                                                <select class="form-control form-select select2" name="office" id="office">
                                                    <option value="">Select</option>
                                                    @foreach ($offices as $office)
                                                    <option value="{{ $office->id }}"
                                                        {{ $office->id == request('office') ? 'selected' : '' }}>
                                                        {{ $office->office_sub[0]->title }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <!-- Start Date -->
                                            <div class="col-md-3">
                                                <label for="start_date" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" name="start_date" id="start_date"
                                                    value="{{ request('start_date') }}">
                                            </div>

                                            <!-- End Date -->
                                            <div class="col-md-3">
                                                <label for="end_date" class="form-label">End Date</label>
                                                <input type="date" class="form-control" name="end_date" id="end_date"
                                                    value="{{ request('end_date') }}">
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between mb-3">
                                            <div class="col-md-3">
                                                <label for="typeId" class="form-label">Select Type</label>
                                                <select class="form-control form-select select2" name="type_id" id="type_id">
                                               
                                                    <option selected>Select Type</option>
                                                    <option value="0" @if(isset($type_id) && $type_id == 0) selected @endif>Suggestion</option>
                                                    <option value="1" @if(isset($type_id) && $type_id == 1) selected @endif>Announcement</option>
                                                    <option value="2" @if(isset($type_id) && $type_id == 2) selected @endif>Whats new</option>
                                                    <option value="3" @if(isset($type_id) && $type_id == 3) selected @endif>Awards</option>
                                                    <option value="4" @if(isset($type_id) && $type_id == 4) selected @endif>Initiatives</option>
                                                    <option value="5" @if(isset($type_id) && $type_id == 5) selected @endif>Over view</option>
                                                    <option value="6" @if(isset($type_id) && $type_id == 6) selected @endif>Wellness Tip</option>
                                                    <option value="7" @if(isset($type_id) && $type_id == 7) selected @endif>Projects</option>
                                                    <option value="8" @if(isset($type_id) && $type_id == 8) selected @endif>Banner</option>
                                                    <option value="9" @if(isset($type_id) && $type_id == 9) selected @endif>MIS</option>
                                                    <option value="10" @if(isset($type_id) && $type_id == 10) selected @endif>About Department</option>
                                                    <option value="11" @if(isset($type_id) && $type_id == 11) selected @endif>Publication</option>
                                                    <option value="12" @if(isset($type_id) && $type_id == 12) selected @endif>Dashboard</option>
                                                    <option value="13" @if(isset($type_id) && $type_id == 13) selected @endif>Sustainable Development Goals</option>
                                                    <option value="14" @if(isset($type_id) && $type_id == 14) selected @endif>Emergency Information</option>
                                                    <option value="15" @if(isset($type_id) && $type_id == 15) selected @endif>Health Alerts</option>
                                                    <option value="16" @if(isset($type_id) && $type_id == 16) selected @endif>Grievance Section</option>
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Second Row: Search and Add New Button -->
                                        <div class="d-flex justify-content-between">
                                            <!-- Search Button -->
                                            <div class="col-md-3">
                                                <button type="submit" class="btn btn-primary w-100">Search</button>
                                            </div>
                                            <!-- Refresh Button -->
                                            <div class="col-md-3">
                                                @if(Auth::user()->role_id ==7)
                                                <a href="{{ route('acs.suggestionreport') }}" class="btn btn-success w-100">Refresh</a>
                                                @else
                                                <a href="{{ route('editor.suggestionreport') }}" class="btn btn-success w-100">Refresh</a>
                                                @endif <!-- <button type="button" class="btn btn-secondary w-100" onclick="window.location.reload();">Refresh</button> -->
                                            </div>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>




                    <div class="row mt-3">
                        <div class="col-9">
                            <div class="col-3 text-start mb-3 px-2">
                                <button id="downloadButton" class="btn btn-secondary mt-3">
                                    Download CSV
                                </button>
                            </div>

                        </div>
                        <!-- <div class="col-3  text-end mb-3">
                            <a href="{{ route('acs.reportpdf') }}" class="btn btn-secondary mt-3" target="_blank">
                                Download PDF
                            </a>
                        </div> -->

                    </div>
                    <table id="datatable_view" class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Designation/Office</th>
                                <th>Status</th>
                                <th>Approve remark</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $result)
                            <tr>

                                @php
                                $createdDate = \Carbon\Carbon::parse($result->created_at)->startOfDay();
                                $currentDate = \Carbon\Carbon::now()->startOfDay();

                                // Calculate the difference in days
                                $pendingDays = $createdDate->diffInDays($currentDate, false);
                                @endphp

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
                                <td>@foreach($result->user as $user){{ $user->name }} @endforeach</td>
                                <td>{{ $result->title }}</td>
                                <td>@foreach($result->user as $user)

                                    @foreach($user->designationdata as $designationdata)
                                    {{ $designationdata->des_sub[0]->title }}
                                    @endforeach
                                    /
                                    @foreach($user->officedata as $officedata)
                                    {{ $officedata->office_sub[0]->title }}
                                    @endforeach

                                    @endforeach
                                </td>

                                <td>@if($result->approverstatus==0)
                                    <button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;">
                                        <i class="fa fa-info-circle"></i>
                                    </button>
                                    @elseif($result->approverstatus==1)
                                    <button type="button" class="btn btn-success btn-xs dt-edit" style="margin-right:16px;">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </button><br>
                                    <!-- <span>{{$result->approverremark}}</span> -->
                                    @elseif($result->approverstatus==2)
                                    <button type="button" class="btn btn-danger btn-xs dt-edit" style="margin-right:16px;">
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </button><br>
                                    <!-- <span>{{$result->approverremark}}</span> -->
                                    @endif
                                </td>
                                <td>{{$result->approverremark}}</td>
                                <td>

                                    <!-- <button type="button" class="btn button-10 button-101 bt-change" value="{{ $result->id}}" id="approve"  data-bs-toggle="modal" data-bs-target="#exampleModal">Approve</button>
                                    <button type="button" class="btn button-10 button-102 bt-change" value="{{ $result->id}}" id="reject"  data-bs-toggle="modal" data-bs-target="#exampleModal">Reject</button><br> -->

                                    @if(Auth::user()->role_id ==7)
                                    <a type="button" class="btn button-10 button-101 bt-change" value="{{ $result->id}}" id="approve" href="{{ route('acs.suggestiondetails',\Crypt::encryptString($result->id)) }}">Preview</a><br>
                                    @else
                                    <a type="button" class="btn button-10 button-101 bt-change" value="{{ $result->id}}" id="approve" href="{{ route('editor.suggestiondetails',\Crypt::encryptString($result->id)) }}">Preview</a><br>
                                    @endif
                                    <a class="badge bg-secondary btn-sm-default">Pending days {{ $pendingDays }}</a><br>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div> <!--card2 -->

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Note : Approve Hero of the month</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('acs.storeHeroOfMonthRemark') }}">
                    @csrf
                    <input type="hidden" name="selOpt" id="selOpt">
                    <input type="hidden" name="hidden_id" id="hidden_id" val="">
                    <div class="modal-body">
                        <textarea id="remark" class="form-control @error('remark') is-invalid @enderror" name="remark" required autocomplete="remark" placeholder="Enter remark here" autofocus></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="approvestatussubmt" class="btn btn-primary sbt-btn">Approve</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {
        $("#downloadButton").on("click", function() {
            // Initialize CSV content with header row
            let csvContent = "No,Name,Subject,Office,Status,Approve Remark\n";

            // Loop through the data and append rows
            @foreach($data as $key => $result)
            csvContent += `{{ $loop->iteration }},{{ $result->user[0]->name ?? '' }},{{ $result->title }},{{ $result->user[0]->officedata[0]->office_sub[0]->title ?? '' }},{{ $result->approverstatus }},{{ $result->approverremark }}\n`;
            @endforeach

            // Create a Blob from the CSV content
            const blob = new Blob([csvContent], {
                type: "text/csv"
            });
            const url = URL.createObjectURL(blob);

            // Trigger download using a temporary link
            const tempLink = $("<a></a>")
                .attr("href", url)
                .attr("download", "suggestions_report.csv")
                .appendTo("body");

            tempLink[0].click();

            // Cleanup
            tempLink.remove();
            URL.revokeObjectURL(url);
        });
    });
</script>
<script>
    $('#office').select2({
        placeholder: "Select an option",
        allowClear: true
    });


    $(document).ready(function() {
        $('#component').on('keyup', function(e) {
            var testres = engtitle('#component', this.value);
            if (!testres) {
                $('.titleerr').text("Not Allowed ");

                $('.titleerr').show();

            } else {
                $('.titleerr').hide();
            }
        });

        $(".bt-change").on("click", function() {
            var optionSel = $(this).attr('id');
            var hidden_id = $('.bt-change').val();

            $('#selOpt').val(optionSel);
            $('#hidden_id').val(hidden_id);
            if (optionSel == 'reject') {
                $('#approvestatussubmt').text('Reject').css('background-color', 'red');
            } else {
                $('#approvestatussubmt').text('Approve').css('background-color', 'blue');
            }
        });
    });
</script>
@endsection