@extends('layouts.shop_control')
@section('title', __('Edit category'))

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{ __('Edit category') }}</h2>
                <div class="nk-block-des">
                    <p>{{ __('Editing Category Information') }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-4 flex-wrap">
                    <li>
                        <a class="back-to" href="{{ url()->previous() }}">
                            <em class="icon ni ni-arrow-left"></em>
                            <span>{{ __('Return to back') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="nk-block">
        <div class="card shadow">
            <div class="card-inner">
                <div class="mb-3" id="errors"></div>
                <form action="{{ route('shop.items.categories.edit', ['shop' => $shop->id, 'category' => $category->id]) }}" method="POST" class="gy-3">
                    @csrf
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="name">
                                    {{ __('Name of category') }}:</label>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $category->name }}"
                                           placeholder="{{ __('Name of category') }}" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="position">
                                    {{ __('Position') }}:</label>
                                <span class="form-note">{{ __('The higher the position, the first the product is displayed on the shop page') }}</span>
                                <span class="form-note">{{ __('Optional field') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="position" name="position" value="{{ $category->position }}"
                                           placeholder="{{ __('Position') }}" required="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3">
                        <div class="col-lg-12 offset-lg-4">
                            <div class="form-group mt-2">
                                <button type="submit" class="btn btn-lg btn-success">{{ __('Apply changes') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
