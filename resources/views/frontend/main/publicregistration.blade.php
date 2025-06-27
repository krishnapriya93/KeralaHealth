@extends('frontend.layouts.main_header')

@section('content')
<style>
    .page-content {
        background-image: url('{{ asset('assets/frontend/images/foot-logo.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .card.glass {
        background-color: rgba(255, 255, 255, 0.95);
        border: 1px solid #dee2e6;
        border-radius: 1rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .form-title {
        font-weight: 700;
        color: #333;
    }

    .form-label {
        font-weight: 500;
        color: #333;
    }

    .form-control {
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 0.5rem;
        color: #333;
    }

    .form-control:focus {
        background-color: #fff;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }

    .btn-modern {
        background: #007bff;
        color: #fff;
        font-weight: bold;
        border-radius: 50px;
        transition: all 0.3s ease;
    }

    .btn-modern:hover {
        background: #0056b3;
        color: #fff;
    }

    .form-check-label {
        color: #333;
    }

    @media (max-width: 768px) {
        .card.glass {
            margin: 0 1rem;
        }
    }
</style>

<div class="page-wrapper">

    <!-- Header -->
    @include('frontend.layouts.main_menu')

    <div class="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card glass p-4">
                        <h2 class="form-title text-center mb-4">Create an Account</h2>
                        <form method="POST" action="{{ route('main.storepublicregistration') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
                            </div>

                            <div class="mb-3">
                                <label for="mobile" class="form-label">Mobile Number</label>
                                <input type="number" name="mobile" id="mobile" class="form-control" placeholder="Enter your mobile number" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                            </div>

                            <div class="mb-3">
                                <label for="pass" class="form-label">Password</label>
                                <input type="password" name="pass" id="pass" class="form-control" placeholder="Create password" required>
                            </div>

                            <div class="mb-3">
                                <label for="re_pass" class="form-label">Confirm Password</label>
                                <input type="password" name="re_pass" id="re_pass" class="form-control" placeholder="Repeat your password" required>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="agree-term" required>
                                <label class="form-check-label" for="agree-term">
                                    I agree to all statements in <a href="#" class="text-primary">Terms of Service</a>
                                </label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-modern">
                                    Register Now
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('frontend.layouts.main_footer')
</div>

@include('frontend.layouts.search_scroll')
@include('frontend.layouts.include_scripts')
@endsection
