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
                <div class="card-header text-white card-header-main">{{ __('List of Hero of the month - Approval') }}</div>

                <div class="card-body">
                    <table id="datatable_view" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Month - Year</th>
                                <th width="280px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $result)
                            <tr>
                                @php
                                $formattedDate = \Carbon\Carbon::parse($result->date)->format('F Y');
                                @endphp
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result->heromonthsub[0]->title }}</td>
                                <td>{{ $formattedDate }}</td>
                                <td>

                                    <!-- <button type="button" class="btn button-10 button-101 bt-change" value="{{ $result->id}}" id="approve"  data-bs-toggle="modal" data-bs-target="#exampleModal">Approve</button>
                                    <button type="button" class="btn button-10 button-102 bt-change" value="{{ $result->id}}" id="reject"  data-bs-toggle="modal" data-bs-target="#exampleModal">Reject</button><br> -->

                                    <a type="button" class="btn button-10 button-101 bt-change" value="{{ $result->id}}" id="approve"  href="{{ route('acs.heromonthdetails',\Crypt::encryptString($result->id)) }}" >Preview</a><br>
                                    <a class="badge bg-secondary btn-sm-default">Pending days {{ Carbon\Carbon::parse($result->date)->diffInDays(Carbon\Carbon::now()) }}</a><br>
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