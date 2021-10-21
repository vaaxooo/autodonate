@extends('layouts.auth')
@section('title', __('Register'))

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
                        <h4 class="nk-block-title">{{ __('Register') }}</h4>
                        <div class="nk-block-des">
                            <p>{{ __('Create a new account') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mb-3" id="errors"></div>

                <form action="{{ route('account.auth.register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="default-01">E-mail</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="email" class="form-control form-control-lg" id="email" name="email"
                                   placeholder="{{ __('Enter your email address') }}" autocomplete="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="password">{{ __('Password') }}</label>
                        </div>
                        <div class="form-control-wrap">
                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                            </a>
                            <input type="password" class="form-control form-control-lg" id="password" name="password"
                                   placeholder="{{ __('Enter your password') }}" autocomplete="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-control-xs custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="agreement" name="agreement">
                            <label class="custom-control-label" for="agreement">
                                {{ __('I have read and agree with') }} <a href="#">{{ __('agreement-offer') }}</a>.
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-success btn-block" name="btnRegister"
                                id="btnRegister">{{ __('btnRegister') }}</button>
                    </div>
                </form>
                <div class="form-note-s2 text-center pt-4">
                    {{ __('Do you have an account?') }} -
                    <a href="{{ route('account.auth.login') }}">{{ __('Login') }}</a>
                </div>
            </div>
        </div>

        @include('components.app.footer')
    </div>

@endsection