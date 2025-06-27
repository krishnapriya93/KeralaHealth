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
</style>
@section('content')
<!-- <nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!!$breadcrumbarr!!}
    </ol>
</nav> -->

<div class="container">
    <div class="row justify-content-center">
        @foreach ($data->heromonthsub as $heromonthsub)

        <div class="card">
            <h1>Hero of the Month</h1><br>
            @php
               $formattedDate = \Carbon\Carbon::parse($data->date)->format('F Y');
            @endphp
            <img src="{{ asset('/assets/backend/uploads/HeroOfMonth/'.$data->file) }}" style="width: 18rem;" class="card-img-top" alt="...">
            <p class="card-text">{{$formattedDate }}</p>
            <div class="card-body">
                <h5 class="card-title">{{$heromonthsub->title}}</h5>
                
                <p class="card-text">{!! $heromonthsub->description !!}</p>
               
                <div class="mt-4">
                    <button type="button" class="btn button-10 button-101 bt-change" value="{{ $data->id}}" id="approve" href="{{ route('acs.heromonthdetails',\Crypt::encryptString($data->id)) }}" data-bs-toggle="modal" data-bs-target="#exampleModal">Approve</button>
                    <button type="button" class="btn button-10 button-102 bt-change" value="{{ $data->id}}" id="reject" href="{{ route('acs.heromonthdetails',\Crypt::encryptString($data->id)) }}" data-bs-toggle="modal" data-bs-target="#exampleModal">Reject</button>
                    <a type="button" class="btn button-10 button-103 bt-change" value="{{ $data->id}}" id="approve" href="{{ route('acs.HerooftheMonthApprove') }}" >Back</a>
                </div>

            </div>
        </div>
        @endforeach

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
            } else {
                $('#approvestatussubmt').text('Approve').css('background-color', 'blue');
            }
        });
        });
    </script>
    @endsection