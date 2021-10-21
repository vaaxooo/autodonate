@extends('layouts.shop_control')
@section('title', __('Products'))

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{ __('Products') }}</h2>
                <div class="nk-block-des">
                    <p>{{ __('You have total :count', ['count' => $items->total()])." ".trans_choice('productsFormat', $items->total()) }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="{{ route('shop.items.create', ['shop' => $shop->id]) }}" class="btn btn-success">
                            <em class="icon ni ni-plus mr-2"></em> {{ __('New product') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop.items.categories', ['shop' => $shop->id]) }}" class="btn btn-light">
                            {{ __('Categories') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="nk-block">

        @if(count($items) > 0)
            <div class="card shadow">
                <div class="card-inner-group">
                    <div class="card-inner p-0">
                        <div class="nk-tb-list">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col">
                                    <span>{{ __('Name product') }}</span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span>{{ __('Category') }}</span>
                                </div>
                                <div class="nk-tb-col">
                                    <span>{{ __('Price') }}</span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools"></div>
                            </div>
                            @foreach($items as $item)
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-product">
                                            <img src="{{ asset($item->image) }}" alt="" class="thumb">
                                            <span class="title">{{ $item->name }}</span>
                                        </span>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="tb-sub">{{ $item->category_id ? $item->category()->first()['name'] : __('Not available') }}</span>
                                    </div>
                                    <div class="nk-tb-col">
                                        <span class="tb-lead">{{ $item->formatPrice() }}</span>
                                    </div>
                                    <div class="nk-tb-col nk-tb-col-tools">
                                        <ul class="nk-tb-actions gx-1 my-n1">
                                            <li class="mr-n1">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                       data-toggle="dropdown">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="{{ route('shop.items.edit', ['shop' => $shop->id, 'item' => $item->id]) }}">
                                                                    <em class="icon ni ni-edit"></em>
                                                                    <span>{{ __('Edit Product') }}</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('shop.items.delete', ['shop' => $shop->id, 'item' => $item->id]) }}">
                                                                    <em class="icon ni ni-trash"></em>
                                                                    <span>{{ __('Remove Product') }}</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <h5 class="text-soft">{{ __('The list of products is empty.') }}</h5>
        @endif

    </div>

    @include('components.app.partials.pagination', ['action' => $items])

@endsection
