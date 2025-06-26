@extends('backend.layouts.htmlheader')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a href="{{ route('masteradminhome') }}">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Password change</li>
    </ol>
</nav>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-white card-header-main">Update Password
                </div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                    @endif
                    @foreach ($errors->all() as $error)

                    <li><p class="text-danger">{{ $error }}</p></li>

                    @endforeach 
                    <form id="formiid" method="POST" action="{{ route('officer.passwordupdate') }}"
                        enctype="multipart/form-data">


                        @csrf
                        <input type="hidden" name="hidden_id" value="{{ $keydata->id ?? '' }}">
                        <input type="hidden" id="role_id" name="role_id" value="{{ $keydata->role_id ?? '' }}">
                        <input type="hidden" id="edit_id" name="edit_id" value="{{ $edit_f ?? '' }}">


                        <div class="row mb-3">
                            <label for="new_password" class="col-sm-2 col-form-label">New Password <span class="redalert">
                                    *</span></label>
                            <div class="col-sm-10">
                                <input id="new_password" type="text"
                                    class="form-control @error('new_password') is-invalid @enderror" name="new_password"
                                    value="{{ $keydata->name ?? old('new_password') }}" required autocomplete="new_password"
                                    placeholder="Enter new_password here">
                                <span class="ErrP usernameerr redalert" style="display: none;">Please Check the password
                                    Entered</span>
                                <span class="redalert">
                                    @error('new_password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-sm-2 col-form-label">Confirm New Password<span class="redalert">
                                    *</span></label>
                            <div class="col-sm-10">
                                <input id="password-confirm" type="password"
                                    class="form-control @error('password-confirm') is-invalid @enderror" name="password-confirm"
                                    value="" required autocomplete="password" placeholder="Enter password-confirm here">
                                <span class="ErrP  passworderr redalert" style="display: none;">Please Check the password-confirm
                                    Entered</span>
                                <span class="redalert">
                                    @error('password-confirm')
                                    {{ $message }}
                                    @enderror
                                </span>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-10 offset-sm-2">
                                <button type="submit" class="btn btn-warning">Update</button>
                            </div>
                        </div>
                    </form>

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
        var edit = $('#edit_id').val();
        $('.ErrP').hide();
        $('#subtype_div').hide();
        if (edit) {
            var role_id = $('#role_id').val();

            if (role_id == 5) {
                $('#subtype_div').show();
            }
        }


        //sbutype
        $('#usertype').on('change', function(e) {
            var subid = this.value;
            if (subid == 5) {
                $('#subtype_div').show();
            } else {
                $('#subtype_div').hide();
            }
        })
        //password

        $('#password').on('keyup', function(e) {
            var testres = passwordcheck('#password', this.value);

            if (testres != 'true') {
                $('.passworderr').html('');
                $('.passworderr').html(testres);
                $('.passworderr').show();

            } else {
                $('.passworderr').hide();
                var testres = confirmpass('password', 'cnfpassword');

                if (testres != 'true') {
                    $('.cnfpassworderr').html('');
                    $('.cnfpassworderr').html(testres);
                    $('.cnfpassworderr').show();

                } else {
                    $('.cnfpassworderr').hide();
                }
            }

        });

        //fullname
        $('#fullname').on('keyup', function(e) {
            var testres = engtitle('#fullname', this.value);
            if (!testres) {
                $('.fullnameerr').text(
                    "Characters allowed: Alphabets, numbers and special characters such as spaces . , / - _ & @ '\" ? % ! ( ) ; < >  [ ] . No consecutive special characters are allowed except for the combination of space with . , /. "
                );

                $('.fullnameerr').show();

            } else {
                $('.fullnameerr').hide();
            }
        });

        //mobile

        $('#mobile').on('keyup', function(e) {
            var testres = mobileval('#mobile', this.value);
            if (!testres) {
                $('.mobileerr').text('Only numbres and must be 10 digits');

                $('.mobileerr').show();

            } else {
                $('.mobileerr').hide();
            }
        });

        //username
        $('#username').on('keyup', function(e) {
            var testres = engtitle('#username', this.value);
            if (!testres) {
                $('.usernameerr').text('Not Allowed');
                $('.usernameerr').show();

            } else {
                $('.usernameerr').hide();
            }
        });

        $('#savbtn').on('click', function(e) {
            var flag = 0;
            $(".ErrP").each(function(index) {
                if ($(this).css('display') == 'inline') {
                    flag = 1;
                }
            });
            if (flag == 1) {
                e.preventDefault();
                return false;
            } else {

            }
        });

    });
</script>
@endsection