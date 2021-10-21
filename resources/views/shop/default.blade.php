@extends('shop.layouts.default')
@section('title', $shop->name)
@section('content')

    <div class="container mt-5">

        <header class="pb-3 mb-4 d-flex">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none m-1 shop-link mr-3">
                Не прошла оплата?
            </a>
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none m-1 shop-link mr-3">
                Сообщество
            </a>
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none m-1 shop-link mr-3">
                Владелец
            </a>
        </header>


        <div class="p-5 mb-4 bg-light rounded-3"
             style="background: url(https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fimages.hdqwalls.com%2Fdownload%2Fminecraft-dungeons-jungle-awakens-hero-dx-1920x1080.jpg&f=1&nofb=1) center;background-size: cover;">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold shop-name">{{ $shop->name }}</h1>
                <div class="display-5 fw-bold shop-address">IP: <a href="#">{{ $shop->getFullAddress() }}</a></div>
                <a href="#items" class="btn btn-primary btn-lg mt-5">Перейти к товарам</a>
            </div>
        </div>


        <div class="shop-content-menu">
            <div class="menu-link">
                <span class="">Товары</span>
            </div>
        </div>
        <div class="shop-products" id="items">
            <h2 class="text-muted">Товары</h2>
            @if(count($categories) > 0)
                @foreach($categories as $category)
                    <div class="d-block mb-5">
                        @if(count($products = $shop->products()->where('active', true)->where('category_id', $category->id)->where('shop_id', $shop->id)->orderBy('position', 'desc')->get()) > 0)
                            <div class="row mt-2">
                                @foreach($products as $product)
                                    @include('shop.components.default.horizontal_product', ['product' => $product, 'category' => $category])
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                @if(count($products) > 0)
                    <div class="d-block mb-5">
                        <div class="row mt-2">
                            @foreach($products as $product)
                                @include('shop.components.default.horizontal_product', ['product' => $product])
                            @endforeach
                        </div>
                    </div>
                @else
                    <h4 class="text-muted mt-5">Список товаров пуст..</h4>
                @endif
            @endif
        </div>

        <section class="section py-4 wow fadeIn" id="help">
            <h2 class="h2 font-weight-bolder text-dark instructions-title">Инструкция по покупке</h2>
            <div class="wpbs-steps py-5">
                <div class="wpbs-step">
                    <div class="wpbs-step-num">1</div>
                    <div class="wpbs-step-text">Добавьте необходимые товары в корзину и заполните предлагаемую форму.
                    </div>
                </div>
                <div class="wpbs-step">
                    <div class="wpbs-step-num">2</div>
                    <div class="wpbs-step-text">Выберите предпочитаемый способ оплаты и следуйте дальнейшим инструкциям.
                    </div>
                </div>
                <div class="wpbs-step">
                    <div class="wpbs-step-num">3</div>
                    <div class="wpbs-step-text">Товар выдается после оплаты в автоматическом режиме и моментально.
                    </div>
                </div>
            </div>
        </section>


    </div>

    <div class="container-fluid">
        <div class="container footer">

            <div class="wpbs-carousel pay-system-images">
                <img src="{{ asset('assets/images/payicons/visa.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/mastercard.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/mir.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/paykeeper.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/qiwi.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/yoomoney.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/webmoney.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/beeline.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/tele2.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/mts.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/megafon.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/sbp.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/alfabank.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/vtb.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/psb.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/russky_standart.svg') }}" alt="">
                <img src="{{ asset('assets/images/payicons/paymaster.svg') }}" alt=""
                     onclick="location.href='https://info.paymaster.ru/'" style="pointer-events: auto">
            </div>


            <div class="footer-copy">
                © <strong>{{ $shop->name }}</strong>. Создано с помощью <a class="shop-link"
                                                                           href="//{{ env('APP_DOMAIN') }}">{{ env('APP_NAME') }}</a>
            </div>
        </div>
    </div>




@endsection