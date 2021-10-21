<div class="nk-header nk-header-fixed is-light">
    <div class="container-lg wide-xl">
        <div class="nk-header-wrap">
            <div class="nk-header-brand">
                <a href="{{ route('dashboard') }}" class="logo-link">
                    <img class="logo-dark logo-img logo-img-lg" src="{{ asset('assets/images/logo.png') }}" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->
            <div class="nk-header-menu">
                <ul class="nk-menu nk-menu-main">
                    <li class="nk-menu-item">
                        <a href="{{ route('dashboard') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Dashboard') }}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('About') }}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="#" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Contacts') }}</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                </ul><!-- .nk-menu -->
            </div><!-- .nk-header-menu -->
            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    <li class="dropdown notification-dropdown">
                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-toggle="dropdown">
                            <div class="icon-status icon-status-info"><em class="icon ni ni-bell"></em></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-head">
                                <span class="sub-title nk-dropdown-title">{{ __('Notifications') }}</span>
                                {{--<a href="#">{{ __('Mark All as Read') }}</a>--}}
                            </div>
                            <div class="dropdown-body">
                                <div class="nk-notification">

                                    @if(auth()->user()->notifications()->where('read', 0)->orderBy('id', 'desc')->limit(5)->count() > 0)
                                        @foreach(auth()->user()->notifications()->where('read', 0)->orderBy('id', 'desc')->limit(5)->get() as $notification)
                                            <div class="nk-notification-item dropdown-inner">
                                                <div class="nk-notification-icon">
                                                    <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                </div>
                                                <div class="nk-notification-content">
                                                    <div class="nk-notification-text">{{ __($notification->title) }}</div>
                                                    <div class="nk-notification-time">
                                                        {{ __(':date in :time', ['date' => date('d.m.Y', strtotime($notification->created_at)), 'time' => date('H:i', strtotime($notification->created_at))]) }}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-muted text-center py-3">{{ __('The list of notifications is empty...') }}</div>
                                    @endif

                                </div><!-- .nk-notification -->
                            </div><!-- .nk-dropdown-body -->
                            <div class="dropdown-foot center">
                                <a href="{{ route('account.notifications') }}">{{ __('View All') }}</a>
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle mr-lg-n1" data-toggle="dropdown">
                            <span class="fw-bold text-dark mr-2">{{ auth()->user()->getBalance()  }}</span>
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right dropdown-menu-s1">
                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                <div class="user-card">
                                    <div class="user-info">
                                        <span class="lead-text">{{ auth()->user()->getNameOrEmail() }}</span>
                                        <span class="sub-text">{{ __('Balance').": ".auth()->user()->getBalance() }}</span>
                                    </div>
                                    <div class="user-action">
                                        <a class="btn btn-icon mr-n2" href="{{ route('account.details') }}"><em class="icon ni ni-setting"></em></a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="{{ route('account.details') }}">
                                            <em class="icon ni ni-user-alt"></em>
                                            <span>{{ __('View Profile') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('account.billing') }}">
                                            <em class="icon ni ni-wallet"></em>
                                            <span>{{ __('Billing') }}</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('account.security') }}">
                                            <em class="icon ni ni-setting-alt"></em>
                                            <span>{{ __('Settings') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li>
                                        <a href="{{ route('account.auth.logout') }}">
                                            <em class="icon ni ni-signout"></em>
                                            <span>{{ __('Sign out') }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li><!-- .dropdown -->
                    <li class="d-lg-none">
                        <a href="#" class="toggle nk-quick-nav-icon mr-n1" data-target="sideNav"><em class="icon ni ni-menu"></em></a>
                    </li>
                </ul><!-- .nk-quick-nav -->
            </div><!-- .nk-header-tools -->
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>
