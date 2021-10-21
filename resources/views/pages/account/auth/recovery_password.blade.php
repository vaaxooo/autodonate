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
                    </div>
                </div>

                <div class="mb-1" id="errors"></div>

                <form action="{{ route('account.auth.recovery.password', ['link' => $link, 'id' => $id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="new_password">{{ __('New password') }}</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="password" class="form-control form-control-lg" id="new_password" name="new_password" placeholder="{{ __('New password') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-label-group">
                            <label class="form-label" for="repeat_password">{{ __('Repeat password') }}</label>
                        </div>
                        <div class="form-control-wrap">
                            <input type="password" class="form-control form-control-lg" id="repeat_password" name="repeat_password" placeholder="{{ __('Repeat password') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-lg btn-success btn-block">{{ __('CPassword') }}</button>
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