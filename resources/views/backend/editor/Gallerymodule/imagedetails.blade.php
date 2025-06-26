@extends('backend.layouts.htmlheader')
<style>
    body {
        margin: 3em;
    }

    .card-img-top {
        width: 60%;
        border-radius: 50%;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .card {
        padding: 1.5em 0.5em 0.5em;
        text-align: center;
        border-radius: 2em;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-weight: bold;
        font-size: 1.5em;
    }

    .btn-primary {
        border-radius: 2em;
        padding: 0.5em 1.5em;
    }

    .text-justify {
        text-align: justify;
        font-size: 15px;
    }

    .text-size {
        font-size: 15px;
        color: white;
    }
</style>
@section('content')
<!-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!!$breadcrumbarr!!}
    </ol>
</nav> -->

<div class="container">
    <div class="row justify-content-center">


        <div class="card">
            <div class="card shadow-lg border-0 rounded-3 mb-4">
                <!-- <div class="card-header card-header-main text-white"> -->
                <div class="card-header text-size card-header-main">
                    <div>Suggestion - Report</div>
                </div>
                <!-- <div class="mb-0 text-justify ">Suggestion</div> -->
                <!-- </div> -->
                <div class="card-body mt-2">
                    @php
                    $formattedDate = \Carbon\Carbon::parse($data->created_at)->format('d F, Y');
                    @endphp

                    <!-- Date -->
                    <div>
                        <p class="text-start mb-3">
                            <i class="fa fa-user-circle" aria-hidden="true"></i>

                            @foreach($data->user as $userdata)
                            {{$userdata->fullname }}<br>
                            @foreach($userdata->designationdata as $designationdata)
                            @foreach($designationdata->des_sub as $des_sub)
                            {{$des_sub->title}}<br>
                            @endforeach
                            @endforeach
                            @foreach($userdata->officedata as $officedata)
                            @foreach($officedata->office_sub as $office_sub)
                            {{$office_sub->title}}
                            @endforeach
                            @endforeach
                            @endforeach
                        </p>
                        <p class="text-end mb-3">
                            <i class="fa fa-calendar" aria-hidden="true"></i> Received on: {{$formattedDate }}
                        </p>
                    </div>

                    <!-- Subject -->
                    <p class="text-start mt-2 px-3 text-justify mb-3">
                        <i class="fa fa-envelope" aria-hidden="true"></i> <strong>Subject:{{ $data->id }}</strong> {{ $data->title }}
                    </p>

                    <!-- Suggestion -->
                    <span class="text-start mt-2 px-3 text-justify mb-3">
                        <i class="fa fa-tags" aria-hidden="true"></i> <strong>Suggestion:</strong> {!! $data->suggestion !!}
                    </span>

                    <!-- Attachments -->
                    <p class="text-start mt-2 px-3 mb-3">
                        <i class="fa fa-bookmark" aria-hidden="true"></i> <strong>Attachment:</strong>
                    </p>
                    @if($type == 1)
                    @foreach($data->suggItems as $suggItems)
                    <p class="text-start mt-2 px-3 mb-3">
                        <i class="fa fa-paperclip" aria-hidden="true"></i>
                        <a href="{{ asset('/assets/backend/uploads/Suggestionitem/'.$suggItems->image) }}" target="_blank" alt="...">
                            {{ $suggItems->image }}
                        </a>
                    </p>
                    @endforeach
                    @elseif($type == 2)
                    <div class="container mt-3">
                        <div class="row g-4">
                            @foreach($data->suggItems as $suggItem)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="card h-100">
                                    <img src="{{ asset('/assets/backend/uploads/Suggestionitem/'.$suggItem->image) }}"
                                        class="img-fluid"
                                        alt="{{ $suggItem->title }}">
                                    <div class="card-body text-center">
                                        <p class="card-text">{{ $suggItem->title }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @elseif($type == 3)
                    <div class="container mt-3">
                        <div class="row g-4">
                            @foreach($data->suggItems as $suggItem)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="card h-100">
                                    <video controls class="img-fluid">
                                        <source src="{{ asset('/assets/backend/uploads/Suggestionitem/'.$suggItem->video) }}"
                                            type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="card-body text-center">
                                        <p class="card-text">{{ $suggItem->title }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif


                    @if($data->approverstatus != 0)
                    <div class="alert alert-success" role="alert">
                        <div class="text-start"> <i class="fa fa-comments" aria-hidden="true"></i>
                            Admin remark:</div>
                        <div class="text-start">{{$data->approverremark}}</div>
                    </div>

                    @endif
                    <!-- Action Buttons -->
                    <div class="mt-4">
                        @if(Auth::user()->role_id ==7)
                        <a class="btn btn-primary me-2" target="_blank" value="{{ $data->id }}" id="approve" href="{{ route('acs.exportPdf',\Crypt::encryptString($data->id)) }}">Download Data as PDF</a>
                        @else
                        <a class="btn btn-primary me-2" target="_blank" value="{{ $data->id }}" id="approve" href="{{ route('editor.exportPdf',\Crypt::encryptString($data->id)) }}">Download Data as PDF</a>
                        @endif
                        @if($data->approverstatus ==0)
                        @if(Auth::user()->role_id ==7)
                        <button type="button" class="btn btn-success bt-change me-2" value="{{ $data->id }}" id="approve" href="{{ route('acs.suggestionapproverRemark',\Crypt::encryptString($data->id)) }}" data-bs-toggle="modal" data-bs-target="#exampleModal">Approve</button>
                        <button type="button" class="btn btn-danger bt-change me-2" value="{{ $data->id }}" id="reject" href="{{ route('acs.suggestionapproverRemark',\Crypt::encryptString($data->id)) }}" data-bs-toggle="modal" data-bs-target="#exampleModal">Reject</button>
                        <button type="button" class="btn btn-warning bt-change me-2" value="{{ $data->id }}" id="returnback" href="{{ route('acs.suggestionapproverRemark',\Crypt::encryptString($data->id)) }}" data-bs-toggle="modal" data-bs-target="#exampleModal">Revert</button>
                        @endif
                        @endif
                        @if(Auth::user()->role_id ==7)
                        <a type="button" class="btn btn-secondary" value="{{ $data->id }}" id="approve" href="{{ route('acs.suggestionreport') }}">Back</a>
                        @else
                        <a type="button" class="btn btn-secondary" value="{{ $data->id }}" id="approve" href="{{ route('editor.suggestionreport') }}">Back</a>
                        @endif

                    </div>
                </div>
            </div>



        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Note :</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('acs.suggestionapproverRemark') }}">
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
        @endsection
        @section('page_scripts')
        <script>
            $(document).ready(function() {

                $(".bt-change").on("click", function() {
                    var optionSel = $(this).attr('id');
                    var hidden_id = $('.bt-change').val();

                    $('#selOpt').val(optionSel);
                    $('#hidden_id').val(hidden_id);
                    if (optionSel == 'reject') {
                        $('#approvestatussubmt').text('Reject').css('background-color', 'red');
                    } else if (optionSel == 'returnback') {
                        $('#approvestatussubmt').text('Return back').css('background-color', '#f1c232');
                    } else {
                        $('#approvestatussubmt').text('Approve').css('background-color', 'blue');
                    }
                });
            });
        </script>
        @endsection