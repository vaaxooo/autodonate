@extends('layouts.app')
@section('title', __('Security Settings'))

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">{{ __('Profile') }}</h3>
            <div class="nk-block-des">
                <p>{{ __('You have full control to manage your own account setting.') }}</p>
            </div>
        </div>
    </div>

    <div class="nk-block shadow">
        <div class="card">
            @include('pages.account.components.menu')
            <div class="card-inner card-inner-lg">
                <div class="nk-block-head">
                    <div class="nk-block-head-content">
                        <h4 class="nk-block-title">{{ __('Security Settings') }}</h4>
                        <div class="nk-block-des">
                            <p>
                                {{ __('These settings are helps you keep your account secure.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="nk-block">
                    <div class="card">
                        <div class="card-inner-group">
                            <div class="card-inner px-0">
                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                    <div class="nk-block-text"><h6>{{ __('Save my Activity Logs') }}</h6>
                                        <p>{{ __('You can save your all activity logs including unusual activity detected.') }}</p>
                                    </div>
                                    <div class="nk-block-actions">
                                        <ul class="align-center gx-3">
                                            <li class="order-md-last">
                                                <div class="custom-control custom-switch mr-n2 checked">
                                                    <input type="checkbox" class="custom-control-input" @if(auth()->user()->logs) checked @endif id="logs" name="logs">
                                                    <label class="custom-control-label" for="logs"></label></div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner px-0">
                                <div class="between-center flex-wrap g-3">
                                    <div class="nk-block-text"><h6>{{ __('Change Password') }}</h6>
                                        <p>{{ __('Set a unique password to protect your account.') }}</p></div>
                                    <div class="nk-block-actions flex-shrink-sm-0">
                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                            <li class="order-md-last">
                                                <button class="btn btn-light" data-toggle="modal"
                                                        data-target="#change-password">{{ __('CPassword') }}</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-inner px-0">
                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                    <div class="nk-block-text">
                                        <h6>
                                            {{ __('2 Factor Auth') }} &nbsp;
                                            <span class="badge badge-{{ auth()->user()->twofactor ? 'success' : 'danger'  }} ml-0">
                                                {{ auth()->user()->twofactor ? __('Enabled') : __('Disabled')  }}
                                            </span>
                                        </h6>
                                        <p>
                                            {{ __('Protect your account with the 2FA security system. When you activate it, you will need to enter not only your password, but also a special code sent to E-mail.') }}
                                        </p>
                                    </div>
                                    <div class="nk-block-actions">
                                        <button id="twofactor" name="twofactor" class="btn btn-{{ auth()->user()->twofactor ? 'danger' : 'success'  }}">
                                            {{ auth()->user()->twofactor ? __('Disable') : __('Enable')  }}
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-inner px-0">
                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                    <div class="nk-block-text">
                                        <div class="nk-block-head nk-block-head-sm">
                                            <div class="nk-block-head-content">
                                                <h6>{{ __('Security Alerts') }}</h6>
                                                <p>{{ __('You will get only those email notification what you want.') }}</p>
                                            </div>
                                        </div>
                                        <div class="nk-block-content">
                                            <div class="gy-3">
                                                <div class="g-item">
                                                    <div class="custom-control custom-switch checked">
                                                        <input type="checkbox" class="custom-control-input" @if(auth()->user()->smtp_unusual_activity) checked @endif id="smtp_unusual_activity" name="smtp_unusual_activity">
                                                        <label class="custom-control-label" for="smtp_unusual_activity">{{ __('Sending a message when unusual activity is detected') }}</label>
                                                    </div>
                                                </div>
                                                <div class="g-item">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" @if(auth()->user()->smtp_new_browser) checked @endif id="smtp_new_browser" name="smtp_new_browser">
                                                        <label class="custom-control-label" for="smtp_new_browser">{{ __('Sending a message if a new browser is used to log in') }}</label>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="change-password">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <form method="POST" action="{{ route('account.security.change_password') }}">
                    @csrf
                    <div class="modal-body modal-body-lg">
                        <h5 class="title mb-4">{{ __('Change Password') }}</h5>

                        <div class="mb-3" id="errors"></div>

                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="new_password">{{ __('New password') }}</label>
                                    <input type="password" class="form-control form-control-lg" id="new_password" name="new_password" value=""
                                           placeholder="{{ __('New password') }}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="repeat_password">{{ __('Repeat password') }}</label>
                                    <input type="password" class="form-control form-control-lg" id="repeat_password" name="repeat_password"
                                           value="" placeholder="{{ __('Repeat password') }}"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="form-label" for="current_password">{{ __('Current password') }}</label>
                                    <input type="password" class="form-control form-control-lg" id="current_password" name="current_password"
                                           value="" placeholder="{{ __('Current password') }}"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button class="btn btn-lg btn-success">{{ __('CPassword') }}</button>
                                    </li>
                                    <li>
                                        <a href="#" data-dismiss="modal" class="link link-light">{{ __('Cancel') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection