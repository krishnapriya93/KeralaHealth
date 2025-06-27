<!DOCTYPE html>
<html>

<head>
    <title>Data Export</title>
</head>

<body>
    <div class="card-body mt-2">
        @php
        $formattedDate = \Carbon\Carbon::parse($data->created_at)->format('d F, Y');
        @endphp
        <div class="card-header text-size card-header-main">
            <h3>Suggestion - Report</h3>
        </div>

        <!-- Date -->
        <p class="text-end mb-3"><i class="fa fa-calendar" aria-hidden="true"></i> Received on: {{$formattedDate }}</p>

        <!-- Subject -->
        <p class="text-start mt-2 px-3 text-justify mb-3">
            <i class="fa fa-envelope" aria-hidden="true"></i> <strong>Subject:</strong> {{ $data->title }}
        </p>

        <!-- Suggestion -->
        <p class="text-start mt-2 px-3 text-justify mb-3">
            <i class="fa fa-tags" aria-hidden="true"></i> <strong>Suggestion:</strong> {!! $data->suggestion !!}
        </p>

        <!-- Attachments -->
        <p class="text-start mt-2 px-3 mb-3">
            <i class="fa fa-bookmark" aria-hidden="true"></i> <strong>Attachment:</strong>
        </p>
        @foreach($data->suggItems as $suggItems)
        <p class="text-start mt-2 px-3 mb-3">
            <i class="fa fa-paperclip" aria-hidden="true"></i>
            <a href="{{ asset('/assets/backend/uploads/Suggestionitem/'.$suggItems->image) }}" target="_blank" alt="...">{{$suggItems->image}}</a>
        </p>
        @endforeach

    </div>
    <div>
        <!-- Current User -->
        <p>Printed by: {{ Auth::user()->name }}</p>

        <!-- Current Time -->
        <p>Printed Time: {{ \Carbon\Carbon::now()->format('d F, Y H:i:s') }}</p>
    </div>

</body>

</html>