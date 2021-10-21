@extends('layouts.shop_control')
@section('title', $shop->name)

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{ __('Statistic') }}</h2>
                <div class="nk-block-des">
                    <p>{{ __('Complete shop statistics') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="nk-block">

        <div class="card shadow">
            <div class="card-inner">
                <div class="analytic-au">
                    <div class="analytic-data-group analytic-au-group g-3 text-center">
                        <div class="analytic-data analytic-au-data">
                            <div class="title">{{ __('Profit for the month') }}</div>
                            <div class="amount">15 813 ₽</div>
                            <div class="change up"><em class="icon ni ni-arrow-long-up"></em>4.63%</div>
                        </div>
                        <div class="analytic-data analytic-au-data">
                            <div class="title">{{ __('Profit for the week') }}</div>
                            <div class="amount">11 062 ₽</div>
                            <div class="change down"><em class="icon ni ni-arrow-long-down"></em>1.92%</div>
                        </div>
                        <div class="analytic-data analytic-au-data">
                            <div class="title">{{ __('Profit today') }}</div>
                            <div class="amount">3 062 ₽</div>
                            <div class="change up"><em class="icon ni ni-arrow-long-up"></em>3.45%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .card -->


    </div>

@endsection
