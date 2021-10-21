@extends('layouts.app')
@section('title', __('Profile'))

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
                        <h4 class="nk-block-title">{{ __('Personal Information') }}</h4>
                        <div class="nk-block-des">
                            <p>
                                {{ __('Basic information such as your name and the currency you use on the site.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="nk-block">


                    <div class="profile-ud-list">
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">{{ __('Full Name') }}:</span>
                                <span class="profile-ud-value">
                                    {{ auth()->user()->getFullname() }}
                                    <em class="icon ni ni-edit" data-toggle="modal" data-target="#profile-edit"></em>
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">{{ __('Date of registration') }}:</span>
                                <span class="profile-ud-value">{{ __(':date in :time', ['date' => auth()->user()->getRegisterDate(), 'time' => auth()->user()->getRegisterDateTime()]) }}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">{{ __('Phone Number') }}:</span>
                                <span class="profile-ud-value">
                                    {{ auth()->user()->getPhone() }}
                                    <em class="icon ni ni-edit" data-toggle="modal" data-target="#profile-edit"></em>
                                </span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">{{ __('Balance') }}:</span>
                                <span class="profile-ud-value">{{ auth()->user()->getBalance() }}</span>
                            </div>
                        </div>
                        <div class="profile-ud-item">
                            <div class="profile-ud wider">
                                <span class="profile-ud-label">E-mail:</span>
                                <span class="profile-ud-value">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" role="dialog" id="profile-edit">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <form method="PUT" action="{{ route('account.details') }}">
                    @csrf
                    <div class="modal-body modal-body-lg">
                        <h5 class="title mb-4">{{ __('Update Profile') }}</h5>
                        <div class="row gy-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="fullname">{{ __('Full Name') }}</label>
                                    <input type="text" class="form-control form-control-lg" id="fullname" name="fullname" value="{{ auth()->user()->fullname }}" placeholder="{{ __('Full Name') }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="phone">{{ __('Phone Number') }}</label>
                                    <input type="text" class="form-control form-control-lg" id="phone" name="phone" value="{{ auth()->user()->phone }}" placeholder="{{ __('Phone Number') }}" />
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="align-center flex-wrap flex-sm-nowrap gx-4 gy-2">
                                    <li>
                                        <button class="btn btn-lg btn-success">{{ __('Update Profile') }}</button>
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