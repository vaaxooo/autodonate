@extends('layouts.app')
@section('title', __('Notifications'))

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
                        <h4 class="nk-block-title">{{ __('Notifications') }}</h4>
                        <div class="nk-block-des">
                            <p>
                                {{ __('History of recent notifications.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="nk-block">

                    <div class="timeline">
                        @if(count($notifications) > 0)
                        <ul class="timeline-list">


                            @foreach($notifications as $notification)
                                <li class="timeline-item notification mb-2">
                                    <div class="timeline-status bg-primary is-outline"></div>
                                    <div class="timeline-data">
                                        <h6 class="timeline-title">{{ __($notification->title) }}</h6>
                                        <div class="timeline-date">
                                            {{ __(':date in :time', ['date' => date('d.m.Y', strtotime($notification->created_at)), 'time' => date('H:i', strtotime($notification->created_at))]) }} <em class="icon ni ni-alarm-alt"></em>
                                        </div>
                                        <div class="timeline-des">
                                            {{{ __($notification->description) }}}
                                        </div>
                                    </div>
                                </li>
                            @endforeach

                        </ul>
                        @else
                            <div class="text-muted">{{ __('The list of notifications is empty...') }}</div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection