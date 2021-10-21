@extends('layouts.app')
@section('title', __('My shops'))

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{ __('My shops') }}</h2>
                <div class="nk-block-des">
                    <p>{{ __('Manage your previously created shops') }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="{{ route('shop.create') }}" class="btn btn-success">
                            <em class="icon ni ni-plus mr-2"></em> {{ __('New shop') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="row">
            @if(count($shops) > 0)
                @foreach($shops as $shop)
                    <div class="col-md-6">
                        <div class="card shadow">
                            <div class="kanban-item shop">
                                <div class="kanban-item-title">
                                    <h6 class="title">{{ $shop->name }}</h6>
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <div class="user-avatar-group">
                                            <div class="user-avatar xs @if($shop->active) bg-primary @else bg-danger @endif"></div>
                                        </div>
                                    </a>
                                </div>
                                <ul class="kanban-item-tags">
                                    <li>
                                        <span class="badge badge-light">{{ $shop->getFullAddress() }}</span>
                                    </li>
                                    <li>
                                        <span class="badge badge-primary">{{ $shop->game()->first()['name'] }}</span>
                                    </li>
                                </ul>
                                <div class="kanban-item-meta">
                                    <ul class="kanban-item-meta-list">
                                        <li>
                                            <em class="icon ni ni-notes"></em>
                                            <a class="text-muted" href="//{{ $shop->domain }}.{{ env('APP_DOMAIN') }}">{{ $shop->domain }}.{{ env('APP_DOMAIN') }}</a>
                                        </li>
                                        <li>
                                            <em class="icon ni ni-arrow-long-right"></em>
                                            <a href="{{ route('shop.show', ['shop' => $shop->id]) }}">{{ __('Go to management') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>

        @include('components.app.partials.pagination', ['action' => $shops])

    </div>

@endsection
