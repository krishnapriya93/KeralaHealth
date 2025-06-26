@extends('backend.layouts.htmlheader')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="{{ route('masteradminhome') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">User manual</li>
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white card-header-main">User manual
                </div>

                <div class="button-container mt-3 mb-3 px-3">
                    <a href="{{asset('assets/backend/uploads/usermanual/Kerala_Health_Portal_user_manual.pdf')}}" target="_blank" class="btn btn-primary">Kerala Health portal - User manual</a>
                    <a href="{{asset('assets/backend/uploads/usermanual/Kerala_health_Content_Processing_Mechanism.pdf')}}" target="_blank" class="btn btn-primary">Content Processing Mechanism</a>
                </div>
              
            </div>
            <br>

        </div>
    </div>
</div>
@endsection
@section('page_scripts')
<script>
    $(document).ready(function() {
    

    });
</script>
@endsection