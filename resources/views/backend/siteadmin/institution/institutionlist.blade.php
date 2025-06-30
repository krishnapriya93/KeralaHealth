@extends('backend.layouts.htmlheader')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        {!! $breadcrumbarr !!}
    </ol>
</nav> 

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                @if(Session::get('success') != '')
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('delete'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Deleted!</strong> {{ session('delete') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card-header text-white card-header-main">{{ __('List of Institutions') }}</div>

                <div class="row">
                    <div class="col-sm-9"></div>
                    <div class="col-sm-3 mt-3">
                        <a href="{{ route('kaleidoscope') }}" class="btn btn-flat btn-point btn-sm btn-success">
                            &nbsp;Kaleidoscope
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="datatable_view" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Institution Name</th>
                                <th>District</th>
                                <th>Category</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Phone</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $institution)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $institution->name_of_the_institution }}</td>
                                    <td>{{ $institution->name_of_district }}</td>
                                    <td>{{ $institution->category }}</td>
                                    <td>{{ $institution->lattitude }}</td>
                                    <td>{{ $institution->longitude }}</td>
                                    <td>{{ $institution->phone_number }}</td>
                                    <td>{{ $institution->email_id }}</td>

                                </tr>
                            @endforeach    
                        </tbody>
                    </table>
                </div>
            </div> <!--card-->
        </div>
    </div>
</div>
@endsection

@section('page_scripts')
<script>
    $(document).ready(function () {
        $('#datatable_view').DataTable();

        $(".alert").fadeTo(2000, 500).slideUp(500, function () {
            $(".alert").slideUp(500);
        });

        $('.alert').alert();
    });
</script>
@endsection
