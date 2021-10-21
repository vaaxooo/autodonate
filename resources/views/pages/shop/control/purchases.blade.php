@extends('layouts.shop_control')
@section('title', __('Transactions'))

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{ __('Transactions') }}</h2>
                <div class="nk-block-des">
                    <p>{{ __('Complete information on all purchases') }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-4 flex-wrap">
                    <li>
                        <input type="text" class="form-control form-control-lg input-search"
                               placeholder="{{ __('Search by ID or Nickname') }}">
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card shadow">
            <div class="card-inner">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col" class="border-0">ID</th>
                        <th scope="col" class="border-0">{{ __('Nickname') }}</th>
                        <th scope="col" class="border-0">{{ __('Product') }}</th>
                        <th scope="col" class="border-0">{{ __('Sum') }}</th>
                        <th scope="col" class="border-0">{{ __('Status') }}</th>
                        <th scope="col" class="border-0">{{ __('Date') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="fw-bold border-0" data-label="ID">#12145122</td>
                        <td data-label="{{ __('Nickname') }}" class="border-0">Josh</td>
                        <td data-label="{{ __('Product') }}" class="border-0">VIP</td>
                        <td data-label="{{ __('Sum') }}" class="border-0">
                            <span class="text-success fw-bold">
                                +53.30 ₽
                            </span>
                        </td>
                        <td data-label="{{ __('Status') }}" class="border-0">
                            <span class="badge badge-success">
                                Оплачено
                            </span>
                        </td>
                        <td data-label="{{ __('Date') }}" class="border-0">17.10.2021 в 0:49</td>
                    </tr>
                    <tr>
                        <td class="fw-bold border-0" data-label="ID">#12145122</td>
                        <td data-label="{{ __('Nickname') }}" class="border-0">Josh</td>
                        <td data-label="{{ __('Product') }}" class="border-0">VIP</td>
                        <td data-label="{{ __('Sum') }}" class="border-0">
                            <span class="text-success fw-bold">
                                +53.30 ₽
                            </span>
                        </td>
                        <td data-label="{{ __('Status') }}" class="border-0">
                            <span class="badge badge-success">
                                Оплачено
                            </span>
                        </td>
                        <td data-label="{{ __('Date') }}" class="border-0">17.10.2021 в 0:49</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
