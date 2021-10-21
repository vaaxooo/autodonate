@extends('layouts.auth')
@section('title', __('2 Factor Auth'))

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
                            <p>{{ __('A verification code was sent to your email') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-2" id="message"></div>
                <div class="mb-2 mt-2" id="errors"></div>

                <form action="{{ route('account.auth.login.two_factor') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">{{ __('Code') }}</label>
                            <a href="#" class="link link-primary link-sm" id="twofactor_refresh">{{ __('Resend') }}</a>
                        </div>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control form-control-lg" id="twofactorCode" name="twofactorCode" placeholder="{{ __('Enter the verification code') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-success btn-block">{{ __('Continue') }}</button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4">
                    <a href="{{ route('account.auth.login') }}">
                        <strong>{{ __('Return to login') }}</strong>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection