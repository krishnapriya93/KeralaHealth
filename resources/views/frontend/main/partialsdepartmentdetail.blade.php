@if($officelists->isNotEmpty())
    @foreach($officelists as $officelist)
        @foreach($officelist->office_sub as $office_sub)
            @php
                $FormatTitle = preg_replace('/[^A-Za-z0-9_]/', '', str_replace(' ', '_', $office_sub->title));
            @endphp
            <article class="pbmit-product-style-1 col-md-4 col-lg-3">
                <div class="product">
                    <a href="{{ route('main.department-details', ['title' => $FormatTitle, 'id' => Crypt::encryptString($officelist->id)]) }}">
                        <img src="{{ asset('/assets/backend/uploads/Officelogo/' . $officelist->logo) }}" alt="">
                        <h2>{{ $office_sub->title }}</h2>
                    </a>
                </div>
            </article>
        @endforeach
    @endforeach
@else
    <p>No departments found.</p>
@endif
