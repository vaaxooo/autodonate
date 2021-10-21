<!-- footer @s -->
<div class="nk-footer">
    <div class="container wide-xl">
        <div class="dline">
                <span>{{__('Select a language:')}}</span>
                <a class="nav-link" href="{{ route('language.change', ['locale' => 'en']) }}">English</a>
                <a class="nav-link" href="{{ route('language.change', ['locale' => 'ru']) }}">Русский</a>
        </div>
        <div class="nk-footer-wrap g-2 mt-3">
            <div class="nk-footer-copyright"> &copy; 2022 {{ env('APP_NAME') }}.</div>
        </div>
    </div>
</div>
<!-- footer @e -->
