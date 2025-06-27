<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Kerala Health</title>
    <link rel="shortcut icon" type="image/x-icon" href="fav.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="author" content="C-DIT" />
    <meta name="copyright" content="C-DIT" />
    <meta name="robots" content="follow" />
    <link rel="stylesheet" href="{{ asset('/assets/backend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/backend/css/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/backend/css/lineicons.css') }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <style>
        .background-image {
            /* background-image: url('{{ asset('assets/backend/logo-big.svg') }}'); */
            background-position: center;

            background-repeat: no-repeat;
            height: 100%;
            display: flex;
        }

        .passview {
            color: #a6142d;
        }
    </style>
</head>

<body class="bgcolor bg-image">
    <section class="vh-100">
        <div class="background-image">
            <div class="container-fluid h-custom">
                <div class="row d-flex justify-content-center align-items-center h-100 mt-2">
                    {{-- <div class="col-md-9 col-lg-6 col-xl-5">
                        <span class="h1 fw-bold mb-0 mt-4"><img src="{{ asset('/assets/frontend/images/logo.gif') }}" class="navbar-brand_cus"></span>
                    <img src="{{ asset('/assets/frontend/images/download1.webp') }}" class="img-fluid" alt="Sample image">
                </div> --}}
                <!-- @if ($errors->any())
                        <span class="alert alert-danger" role="alert">{{ $errors->first() }} <i class="lni lni-cogs"></i></span>
                        @endif -->
                <div class="col-md-12 col-lg-6 col-xl-4 offset-xl-1 mt-2 card">
                    <form method="post" action="{{ route('checklogins') }}">
                        @if ($errors->any())
                        <span class="alert alert-danger" role="alert">{{ $errors->first() }} <i class="lni lni-cogs"></i></span>
                        @endif

                        @csrf

                        <div class="fw-normal text-center mb-3 mt-4">
                            <span class="h1 fw-bold mb-0 "><img src="{{ asset('/assets/backend/log-n.png') }}" class="navbar-brand_cus"></span>
                        </div>
                        <h5 class="fw-normal text-center" style="letter-spacing: 1px;">Sign into your account</h5>
                        <br>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form2Example17">Email address</label>
                            <input id="email" type="email" class="form-control-lg form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <br>
                        <div class="form-outline mb-2">
                            <label class="form-label" for="form2Example27">Password</label>
                            <div class="input-group">
                                <input id="password" type="password" class="form-control-lg form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                    <i class="lni lni-eye passview"></i>
                                </button>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <br>

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

                        <div class="pt-1 mt-3 mb-2 d-flex justify-content-between">
                            <a class="mt-2 btn btn-primary float-start" id="login" href="{{ route('main.index') }}">
                                <i class="lni lni-home"></i>
                            </a>
                            <button type="submit" id="formbtn" class="btn log_sub mt-2 text-white float-end">
                                <i class="lni lni-thumbs-up"></i> Login
                            </button>
                        </div>

                        <br>

                        <!-- <a class="small text-muted" href="#!">Forgot password?</a> -->
                        <!-- <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="#!" style="color: #393f81;">Register here</a></p> -->
                    </form>
                </div>
            </div>
        </div>
        </div>
        <footer class="py-3">
            <div class="card">
                <div class="card-footer footer-color text-center text-white footer-setting">
                    Designed and developed by C-DIT. Copyrights @ Kerala Health.
                </div>
            </div>
        </footer>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
</body>

</html>