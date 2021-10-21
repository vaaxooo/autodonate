<ul class="nav nav-tabs nav-tabs-mb-icon nav-tabs-card">
    <li class="nav-item current-page">
        <a class="nav-link" href="{{ route('account.details') }}">
            <em class="icon ni ni-user-fill-c"></em>
            <span>{{ __('Personal') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('account.notifications') }}">
            <em class="icon ni ni-bell-fill"></em>
            <span>{{ __('Notifications') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('account.activity') }}">
            <em class="icon ni ni-activity-round-fill"></em>
            <span>{{ __('Account Activity') }}</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('account.security') }}">
            <em class="icon ni ni-lock-alt-fill"></em>
            <span>{{ __('Security Settings') }}</span>
        </a>
    </li>
</ul>