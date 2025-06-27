<h2>Report - Kerala Health(Welcome message)
<br>
-----------------------------------------------------<br></h2>
<h3>{{ $currentDateTime }}</h3>

<table border="1" style="width: 100%; border-collapse: collapse;" class="table table-striped table-responsive">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Office</th>
            <th>Login status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
     
        @foreach ($data as $key => $result)
        <tr>

            @php
            $createdDate = \Carbon\Carbon::parse($result->sent_at)->format('d-m-y');
            $currentDate = \Carbon\Carbon::now()->startOfDay();
            @endphp

            <td>{{ $loop->iteration }}</td>
            <td>{{ $result->fullname }}</td>
            <td>
                @foreach($result->designationdata as $designationdata)
                {{ $designationdata->des_sub[0]->title }}
                @endforeach

                @foreach($result->officedata as $officedata)
                {{ $officedata->office_sub[0]->title }}
                @endforeach

            </td>
            <td>
            @if(!empty($result->session_id))
                <!-- Code to execute if session_id is not empty -->
                <p>Yes</p>
            @else
                <!-- Code to execute if session_id is empty -->
                <p>No</p>
            @endif


            </td>
            <td>{{ $createdDate }}</td>

        </tr>
        @endforeach
    </tbody>
</table>