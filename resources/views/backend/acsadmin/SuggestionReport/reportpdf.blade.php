<h2>Report @php
    use Carbon\Carbon;
@endphp<br>
-----------------------------------------------------<br></h2>
<h3>{{ Carbon::now()->toDateTimeString() }}</h3>
<table border="1" style="width: 100%; border-collapse: collapse;" class="table table-striped table-responsive">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Office</th>
            <th>Approval Status</th>
            <th>Approval remark</th>
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
            <td>{{ $result->title }}</td>
            <td>@foreach($result->user as $user){{ $user->name }} @endforeach</td>
            <td>@foreach($result->user as $user)

                @foreach($user->designationdata as $designationdata)
                {{ $designationdata->des_sub[0]->title }}
                @endforeach

                @foreach($user->officedata as $officedata)
                {{ $officedata->office_sub[0]->title }}
                @endforeach

                @endforeach
            </td>

            <td>@if($result->approverstatus==0)
                <button type="button" class="btn btn-primary btn-xs dt-edit" style="margin-right:16px;">
                    Pending
                </button>
                @elseif($result->approverstatus==1)
                <button type="button" class="btn btn-success btn-xs dt-edit" style="margin-right:16px;">
                    Aprroved
                </button><br>
                <!-- <span>{{$result->approverremark}}</span> -->
                @elseif($result->approverstatus==2)
                <button type="button" class="btn btn-danger btn-xs dt-edit" style="margin-right:16px;">
                    Reject
                </button><br>
                <!-- <span>{{$result->approverremark}}</span> -->
                @endif
            </td>
            <td>{{$result->approverremark}}</td>
            <td>
                <a class="badge bg-secondary btn-sm-default">Pending days {{ $pendingDays }}</a><br>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>