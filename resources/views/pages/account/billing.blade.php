@extends('layouts.app')
@section('title', __('Billing'))

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h3 class="nk-block-title page-title">{{ __('Balance replenishment') }}</h3>
            <div class="nk-block-des">
                <p>{{ __('Funds are credited to the balance immediately after payment.') }}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="nk-block">
                <div class="form-group">
                    <div class="form-control-wrap">
                        <input type="text" class="form-control form-control-lg form-control-outlined" id="outlined">
                        <label class="form-label-outlined" for="outlined">{{ __('Amount') }}</label>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-control-wrap">
                        <input type="text" class="form-control form-control-lg form-control-outlined disabled" value="{{ auth()->user()->email }}" disabled>
                        <label class="form-label-outlined" for="outlined">E-mail</label>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success">{{ __('Proceed to payment') }}</button>
                </div>
            </div>
        </div>


        <div class="col-md-8">
            <div class="nk-block">
                <div class="card shadow card-stretch">
                    <div class="card-inner-group">
                        <div class="card-inner">
                            <div class="card-title-group">
                                <div class="card-title">
                                    <h5 class="title">{{ __('Latest transactions') }}</h5>
                                </div>
                                <div class="card-tools mr-n1">
                                    <ul class="btn-toolbar">
                                        <li>
                                            <a href="#" class="btn btn-icon search-toggle toggle-search"
                                               data-target="search">
                                                <em class="icon ni ni-search"></em>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-search search-wrap" data-search="search">
                                    <div class="search-content">
                                        <a href="#" class="search-back btn btn-icon toggle-search" data-target="search">
                                            <em class="icon ni ni-arrow-left"></em>
                                        </a>
                                        <input type="text"
                                               class="form-control form-control-sm border-transparent form-focus-none"
                                               placeholder="{{ __('Quick search by order id') }}">
                                        <button class="search-submit btn btn-icon">
                                            <em class="icon ni ni-search"></em>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-inner p-0">
                            <table class="table table-striped py-3">
                                <tbody>
                                <tr>
                                    <td>
                                        <a href="#" class="transaction-id">#<span>4947</span></a>
                                    </td>
                                    <td>{{ __(':date in :time', ['date' => '10-05-2019', 'time' => '15:41']) }}</td>
                                    <td>500.00 ₽</td>
                                    <td>
                                        <span class="badge badge-dot badge-success">{{ __('Paid') }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="transaction-id">#<span>4948</span></a>
                                    </td>
                                    <td>{{ __(':date in :time', ['date' => '17-05-2019', 'time' => '13:45']) }}</td>
                                    <td>300.00 ₽</td>
                                    <td>
                                        <span class="badge badge-dot badge-warning">{{ __('Waiting') }}</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




@endsection