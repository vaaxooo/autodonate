@extends('layouts.shop_control')
@section('title', __('Shop settings'))

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{ __('Shop settings') }}</h2>
                <div class="nk-block-des">
                    <p>{{ __('Editing shop information') }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-4 flex-wrap">
                    <li>
                        <a class="back-to" href="{{ url()->previous() }}">
                            <em class="icon ni ni-arrow-left"></em>
                            <span>{{ __('Return to back') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card shadow">
            <div class="card-inner">
                <div id="message"></div>
                <div class="mb-3" id="errors"></div>
                <form action="{{ route('shop.update', ['shop' => $shop->id]) }}" method="PUT" class="gy-3">
                    @csrf
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="name">{{ __('Name of shop') }}:</label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $shop->name }}" placeholder="{{ __('Name of shop') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="domain">{{ __('Shop Address') }}:</label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="domain" name="domain" value="{{ $shop->domain }}" placeholder="{{ __('Shop Address') }}" required="">
                                        <div class="input-group-append">
                                            <span class="input-group-text">.{{ env('APP_DOMAIN') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="ip">{{ __('IP address and port') }}:</label>
                                <span class="form-note">{{ __('Server IP address and port') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="ip" name="ip" value="{{ $shop->ip }}" placeholder="{{ __('IP address') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="port" name="port" value="{{ $shop->port }}" placeholder="{{ __('Port') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="rcon_password">{{ __('RCON Password') }}:</label>
                                <span class="form-note">{{ __('Mandatory for server communication.') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="rcon_password" name="rcon_password" value="{{ $shop->rcon_password }}" placeholder="{{ __('RCON Password') }}" required="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <label class="form-label" for="game">{{ __('Server type') }}:</label>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select class="form-select" id="game" name="game">
                                        <option value="0" selected disabled>{{ __('Select server type') }}</option>
                                        @if(count($games) > 0)
                                            @foreach($games as $game)
                                                <option value="{{ $game->id }}" @if($game->id == $shop->game) selected @endif>{{ $game->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-7 offset-lg-5">
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-lg btn-success">{{ __('Apply changes') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
