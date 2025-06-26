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
                <div class="card-header text-white card-header-main">{{ __('List of Bulk email') }}</div>
                @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="alert alert-success" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-sm-9"></div>
                        <div class="col-sm-3 mt-3">
                            <a href="{{route('masteradmin.reportmailsent')}}" id="addlogobtn"  target="_blank" class="btn btn-flat btn-point btn-sm btn-secondary">Report</a>
                        </div>
                    </div>

                    <form id="bulk_mail_form" action="{{ route('masteradmin.sendbulkmail') }}" method="POST">
                        @csrf
                        <input type="hidden" name="selected_users" id="selected_users" value="">

                        <table id="datatable_view" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="select_all" />
                                    </th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $result)
                                <tr>
                                    <td>
                                        <input type="checkbox" class="select_item" value="{{ $result->id }}" />
                                    </td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $result->name }}</td>
                                    <td>{{ $result->email }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <button type="button" id="send_bulk_mail" class="btn btn-success">Send Bulk Mail</button>
                    </form>
                </div>


            </div> <!--card2 -->

        </div>
    </div>
</div>
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {
        let allUsersSelected = false; // Tracks if all users are selected

        // Handle "Select All" checkbox
        $('#select_all').on('click', function() {
            if ($(this).prop('checked')) {
                allUsersSelected = true; // Select all users in the dataset
                $('.select_item').prop('checked', true); // Check current page items
            } else {
                allUsersSelected = false; // Deselect all users
                $('.select_item').prop('checked', false); // Uncheck current page items
            }
        });

        // Update "Select All" based on individual checkbox changes
        $('.select_item').on('click', function() {
            allUsersSelected = false; // Reset to manual selection
            if ($('.select_item:checked').length === $('.select_item').length) {
                $('#select_all').prop('checked', true);
            } else {
                $('#select_all').prop('checked', false);
            }
        });

        // Collect selected user IDs
        $('#send_bulk_mail').on('click', function() {
            let selectedUsers = [];
            if (allUsersSelected) {
                selectedUsers = 'all'; // Indicates all users are selected
            } else {
                $('.select_item:checked').each(function() {
                    selectedUsers.push($(this).val());
                });
            }

            if (selectedUsers.length > 0 || allUsersSelected) {
                // Send data to the server
                $('#selected_users').val(selectedUsers === 'all' ? 'all' : selectedUsers.join(','));
                $('#bulk_mail_form').submit();
            } else {
                alert('Please select at least one user.');
            }
        });
    });
</script>

@endsection