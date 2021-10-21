@extends('layouts.app')
@section('title', __('Account Activity'))

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
                        <h4 class="nk-block-title">{{ __('Login Activity') }}</h4>
                        <div class="nk-block-des">
                            <p>
                                {{ __('Here is your last 10 login activities log.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="nk-block">
                    <table class="table table-ulogs">
                        <thead class="thead-light">
                        <tr>
                            <th class="tb-col-os">
                                <span class="overline-title">{{ __('Browser') }}
                                    <span class="d-sm-none">/ IP</span>
                                </span>
                            </th>
                            <th class="tb-col-ip">
                                <span class="overline-title">IP</span>
                            </th>
                            <th class="tb-col-time">
                                <span class="overline-title">{{ __('Time') }}</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                            @if(count($logs) > 0)
                                @foreach($logs as $log)
                                    <tr>
                                        <td class="tb-col-os">{{ $log->browser }}</td>
                                        <td class="tb-col-ip"><span class="sub-text">{{ $log->user_ip }}</span></td>
                                        <td class="tb-col-time">
                                            <span class="sub-text">
                                                {{ __(':date in :time', ['date' => date('d.m.Y', strtotime($log->created_at)), 'time' => date('H:i', strtotime($log->created_at))])  }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection