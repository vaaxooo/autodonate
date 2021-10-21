@extends('layouts.shop_control')
@section('title', __('Categories'))

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{ __('Categories') }}</h2>
                <div class="nk-block-des">
                    <p>{{ __('You have total :count', ['count' => $categories->total()])." ".trans_choice('categoriesFormat', $categories->total()) }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a class="back-to" href="{{ url()->previous() }}">
                            <em class="icon ni ni-arrow-left"></em>
                            <span>{{ __('Return to back') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('shop.items.categories.create', ['shop' => $shop->id]) }}" class="btn btn-success">
                            <em class="icon ni ni-plus mr-2"></em> {{ __('New category') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="nk-block">

        @if(count($categories) > 0)
            <div class="card shadow">
                <div class="card-inner-group">
                    <div class="card-inner p-0">
                        <div class="nk-tb-list">
                            <div class="nk-tb-item nk-tb-head">
                                <div class="nk-tb-col">
                                    <span>{{ __('Name of category') }}</span>
                                </div>
                                <div class="nk-tb-col tb-col-md">
                                    <span>{{ __('Position') }}</span>
                                </div>
                                <div class="nk-tb-col nk-tb-col-tools"></div>
                            </div>
                            @foreach($categories as $category)
                                <div class="nk-tb-item">
                                    <div class="nk-tb-col">
                                        <span class="tb-product">
                                            <span class="title">{{ $category->name }}</span>
                                        </span>
                                    </div>
                                    <div class="nk-tb-col tb-col-md">
                                        <span class="tb-sub">{{ $category->position }}</span>
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
                                                                <a href="{{ route('shop.items.categories.edit', ['shop' => $shop->id, 'category' => $category->id]) }}">
                                                                    <em class="icon ni ni-edit"></em>
                                                                    <span>{{ __('Edit Category') }}</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('shop.items.categories.delete', ['shop' => $shop->id, 'category' => $category->id]) }}">
                                                                    <em class="icon ni ni-trash"></em>
                                                                    <span>{{ __('Delete Category') }}</span>
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
            <h5 class="text-soft">{{ __('The list of categories is empty.') }}</h5>
        @endif

    </div>

    @include('components.app.partials.pagination', ['action' => $categories])

@endsection
