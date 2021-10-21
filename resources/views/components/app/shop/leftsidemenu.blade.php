<div class="nk-aside" data-content="sideNav" data-toggle-overlay="true" data-toggle-screen="lg" data-toggle-body="true">
    <div class="nk-sidebar-menu" data-simplebar>
        <ul class="nk-menu">
            <li class="nk-menu-heading">
                <h6 class="overline-title text-primary-alt">{{ $shop->domain }}.{{ env('APP_DOMAIN') }}</h6>
            </li><!-- .nk-menu-heading -->

            <li class="nk-menu-item">
                <a href="{{ route('shop.show', ['shop' => $shop->id]) }}" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-trend-up"></em>
                    </span>
                    <span class="nk-menu-text">{{ __('Statistic') }}</span>
                </a>
            </li><!-- .nk-menu-item -->

            <li class="nk-menu-item">
                <a href="{{ route('shop.purchases', ['shop' => $shop->id]) }}" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-history"></em>
                    </span>
                    <span class="nk-menu-text">{{ __('Transactions') }}</span>
                </a>
            </li><!-- .nk-menu-item -->

            <li class="nk-menu-item">
                <a href="{{ route('shop.items', ['shop' => $shop->id]) }}" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-dashboard"></em>
                    </span>
                    <span class="nk-menu-text">{{ __('Products') }}</span>
                </a>
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item">
                <a href="{{ route('shop.edit', ['shop' => $shop->id]) }}" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-setting"></em>
                    </span>
                    <span class="nk-menu-text">{{ __('Settings') }}</span>
                </a>
            </li><!-- .nk-menu-item -->
            <li class="nk-menu-item">
                <a href="//{{ $shop->domain }}.{{ env('APP_DOMAIN') }}" class="nk-menu-link">
                    <span class="nk-menu-icon">
                        <em class="icon ni ni-link"></em>
                    </span>
                    <span class="nk-menu-text">{{ __('Open shop') }}</span>
                </a>
            </li><!-- .nk-menu-item -->
        </ul><!-- .nk-menu -->
    </div><!-- .nk-sidebar-menu -->
    <div class="nk-aside-close">
        <a href="#" class="toggle" data-target="sideNav"><em class="icon ni ni-cross"></em></a>
    </div><!-- .nk-aside-close -->
</div><!-- .nk-aside -->

