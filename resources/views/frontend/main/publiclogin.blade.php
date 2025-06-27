@extends('frontend.layouts.main_header')

@section('content')
<style>
    .custom-list ul {
        list-style-type: none;
        padding: 0;
    }

    .custom-list li {
        position: relative;
        padding-left: 25px;
        /* Adjust based on icon size */
        margin-bottom: 10px;
    }

    .custom-list li::before {
        content: '';
        position: absolute;
        left: 0;
        top: 3px;
        /* Render the icon using Blade Icons */
        display: inline-block;
        width: 15px;
        /* Adjust based on icon size */
        height: 15px;
        /* Adjust based on icon size */
        background-size: contain;
        background-repeat: no-repeat;
        background-image: url('{{ asset(' /assets/frontend/images/p1.png') }}');
    }

    li::marker {
        content: none;
    }
</style>

<!-- page wrapper -->
<div class="page-wrapper pbmit-bg-color-light">

    <!-- Header Main Area -->
    @include('frontend.layouts.main_menu')
    <!-- Header Main Area End Here -->

    <!-- page content -->
    <div class="page-content">

    <section class="sign-in py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center g-5">
            <!-- Image Column -->
            <div class="col-lg-6 col-md-8 text-center order-1 order-lg-0">
                <img src="{{ asset('assets/frontend/images/tel1.png') }}" class="img-fluid mb-4" alt="sign in image">
            </div>

            <!-- Form Column -->
            <div class="col-lg-6 col-md-10">
                <div class="card shadow rounded-4 p-4 bg-white">
                    <h2 class="form-title mb-4 text-center">Sign in</h2>
                    <form method="POST" id="login-form" action="{{ route('checklogins') }}">
                    @if ($errors->any())
                        <span class="alert alert-danger" role="alert">{{ $errors->first() }} <i class="lni lni-cogs"></i></span>
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label for="your_name" class="form-label">Your Name</label>
                            <input type="text" name="email" id="your_name" class="form-control" placeholder="Your Name" required>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="your_pass" class="form-label">Password</label>
                            <input type="password" name="password" id="your_pass" class="form-control" placeholder="Password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember-me">
                            <label class="form-check-label" for="remember-me">
                                Remember me
                            </label>
                        </div>

                        <div class="form-group row">
                            <label for="captcha" class="col-md-4 col-form-label text-md-right">Captcha</label>
                            <div class="col-md-8">
                                <span class="captcha-image">{!! Captcha::img() !!}</span> &nbsp;&nbsp;
                                <button type="button" class="btn btn-success refresh-captcha" id="refresh-captcha">Refresh</button>
                                <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror mt-2" name="captcha" required>
                                @error('captcha')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        <div class="d-grid">
                            <button type="submit" name="signin" id="signin" class="btn btn-primary">
                                Log in
                            </button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{ route('main.publicregistration') }}"
                                    class="link-danger">Register</a></p>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



    </div>
    <!-- page content End -->

    <!-------------------------- footer ----------------------------->
    <!-------------------------- footer ----------------------------->
    @include('frontend.layouts.main_footer')

</div>
<!-- page wrapper End -->


@include('frontend.layouts.search_scroll')

<!-- JS
		============================================ -->
<!-- jQuery JS -->
@include('frontend.layouts.include_scripts')
<script type="text/javascript">
        $(document).ready(function() {
            $('.refresh-captcha').click(function() {
                $.ajax({
                    type: 'get',
                    url: '{{ route('refreshCaptcha') }}',
                    success: function(data) {
                        $('.captcha-image').html(data.captcha);
                    }
                });
            });

            $('#togglePassword').click(function() {
                let passwordField = $('#password');
                let passwordFieldType = passwordField.attr('type');
                let toggleIcon = $('#toggleIcon');

                if (passwordFieldType === 'password') {
                    passwordField.attr('type', 'text');
                    toggleIcon.removeClass('bi-eye').addClass('bi-eye-slash');
                } else {
                    passwordField.attr('type', 'password');
                    toggleIcon.removeClass('bi-eye-slash').addClass('bi-eye');
                }
            });
        });
    </script>
@endsection