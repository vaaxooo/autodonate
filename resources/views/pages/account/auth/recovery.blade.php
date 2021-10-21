@extends('layouts.auth')
@section('title', __('Reset Password'))

@section('content')

    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
        <div class="brand-logo pb-4 text-center">
            <a href="#" class="logo-link">
                <img class="logo-light logo-img logo-img-lg" src="{{ asset('assets/images/logo.png') }}" alt="logo">
                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/images/logo.png') }}" alt="logo-dark"></a>
        </div>
        <div class="card shadow mb-4">
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">{{ __('Reset Password') }}</h4>
                        <div class="nk-block-des">
                            <p>{{ __('If you forgot your password, well, then we’ll email you instructions to reset your password.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-1" id="message"></div>
                <div class="mb-1" id="errors"></div>

                <form action="{{ route('account.auth.recovery') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">E-mail</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" id="email" name="email" placeholder="{{ __('Enter your email address') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-success btn-block">{{ __('Send reset link') }}</button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4">
                    <a href="{{ route('account.auth.login') }}">
                        <strong>{{ __('Return to login') }}</strong>
                    </a>
                </div>
            </div>
        </div>

        @include('components.app.footer')
    </div>

@endsection