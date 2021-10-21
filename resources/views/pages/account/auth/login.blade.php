@extends('layouts.auth')
@section('title', __('Login'))

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
                        <h4 class="nk-block-title">{{ __('Sign-In') }}</h4>
                        <div class="nk-block-des">
                            <p>{{ __('Log in to the panel using your email and password.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <button type="button" class="outline google-auth col-12">
                        <span class="google-auth-text">{{ __('Login with Google') }}</span>
                    </button>
                </div>

                <div class="text-center ">
                    <h6 class="overline-title overline-title-sap">
                        <span>{{ __('Or login by email') }}</span>
                    </h6>
                </div>

                <div class="mb-3" id="errors"></div>

                <form action="{{ route('account.auth.login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">E-mail</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="{{ __('Enter your email address') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                            <a class="link link-primary link-sm" href="{{ route('account.auth.recovery') }}">{{ __('Forgot Password?') }}</a>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="{{ __('Enter your password') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-success btn-block">{{ __('Sign in') }}</button>
                    </div>
                </form>
                <div class="form-note-s2 pt-4">
                    {{ __('New to our site?') }} -
                    <a href="{{ route('account.auth.register') }}">{{ __('Create an account') }}</a>
                </div>

                <div class="form-note-s2 pt-2">
                    {{ __('By logging into your account, you agree to') }} <a href="#">{{ __('agreement-offer') }}</a>.
                </div>
            </div>
        </div>

        @include('components.app.footer')
    </div>

@endsection