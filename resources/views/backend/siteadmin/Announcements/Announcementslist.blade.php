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
                <div class="card-header text-white card-header-main">{{ __('List of Alert') }}</div>

                <div class="row">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3 mt-3"><a href="{{route('siteadmin.createannouncements')}}" id="addlogobtn" class="btn btn-flat btn-point btn-sm btn-success"><i class="fas fa-plus"></i>&nbsp;Add New Record</a></div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable_view" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Type</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i = 0;
                                @endphp
                                @foreach ($data as $key => $result)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td style="color: #0a1808;"><b>
                                        @foreach ($result->announcetype as $announcetype)
                                        {{ $announcetype->announcetypesub[0]->title ?? '' }} - 
                                        @endforeach </b>
                                    </td>
                                    <td>{{ $result->announcesub[0]->title ?? '' }}</td>
                                    <td>
                                        @if ($result->status_id == 1)
                                        <a class="main-btn info-btn rounded-full btn-hover btn-sm-default" href="{{ route('siteadmin.statusannouncement',\Crypt::encryptString($result->id)) }}">Active</a>
                                        @else
                                        <a class="main-btn deactive-btn rounded-full btn-hover btn-sm-default" href="{{ route('siteadmin.statusannouncement',\Crypt::encryptString($result->id)) }}">Deactive</a>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm-default" href="{{ route('siteadmin.editannouncement', \Crypt::encryptString($result->id)) }}">Edit</a>
                                        <a class="btn btn-danger btn-sm-default" href="{{ route('siteadmin.deleteannouncement', \Crypt::encryptString($result->id)) }}" onclick="return confirm('Are you sure you want to delete this announcement?')">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                </div>
            </div> <!--card2 -->

        </div>
    </div>
</div>
@endsection
@section('mainscript')
<script>
    $(document).ready(function() {


    });
</script>
@endsection