<div class="nk-aside" data-content="sideNav" data-toggle-overlay="true" data-toggle-screen="lg" data-toggle-body="true">
    <div class="nk-sidebar-menu" data-simplebar>
        <ul class="nk-menu">
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">{{ __('Navigation') }}</h6>
            </li><!-- .nk-menu-heading -->

            <li class="nk-menu-item">
                <a href="{{ route('dashboard') }}" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-dashboard"></em>
                    </span>
                    <span class="nk-menu-text">{{ __('Dashboard') }}</span>
                </a>
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item">
                <a href="{{ route('shop.index') }}" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-server"></em>
                    </span>
                    <span class="nk-menu-text">{{ __('My shops') }}</span>
                </a>
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item has-sub">
                <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-users"></em>
                    </span>
                    <span class="nk-menu-text">{{ __('Account') }} </span>
                </a>
                <ul class="nk-menu-sub">
                    <li class="nk-menu-item">
                        <a href="{{ route('account.details') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('View Profile') }}</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('account.billing') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Billing') }}</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('account.security') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Settings') }}</span>
                        </a>
                    </li>
                </ul><!-- .nk-menu-sub -->
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item has-sub">
                <a href="#" class="nk-menu-link nk-menu-toggle">
                    <span class="nk-menu-icon"><em class="icon ni ni-help-alt"></em></span>
                    <span class="nk-menu-text">{{ __('Support') }}</span>
                </a>
                <ul class="nk-menu-sub">
                    <li class="nk-menu-item">
                        <a href="{{ route('tickets.create') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('New request') }}</span>
                        </a>
                    </li>
                    <li class="nk-menu-item">
                        <a href="{{ route('tickets.index') }}" class="nk-menu-link">
                            <span class="nk-menu-text">{{ __('Requests history') }}</span>
                        </a>
                    </li>
                </ul><!-- .nk-menu-sub -->
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item">
                <a href="{{ route('account.auth.logout') }}" class="nk-menu-link">
                    <span class="nk-menu-icon"><em class="icon ni ni-signout"></em></span>
                    <span class="nk-menu-text">{{ __('Sign out') }}</span>
                </a>
            </li>
        </ul><!-- .nk-menu -->
    </div><!-- .nk-sidebar-menu -->
    <div class="nk-aside-close">
        <a href="#" class="toggle" data-target="sideNav"><em class="icon ni ni-cross"></em></a>
    </div><!-- .nk-aside-close -->
</div><!-- .nk-aside -->

