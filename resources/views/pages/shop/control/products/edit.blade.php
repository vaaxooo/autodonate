@extends('layouts.shop_control')
@section('title', __('Edit product'))

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{ __('Edit product') }}</h2>
                <div class="nk-block-des">
                    <p>{{ __('Editing product information') }}</p>
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
                <form action="{{ route('shop.items.edit', ['shop' => $shop->id, 'item' => $item->id]) }}" method="POST"
                      class="gy-3">
                    @csrf
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="name">
                                    <b class="text-danger">*</b>
                                    {{ __('Name of product') }}:</label>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ $item->name }}" placeholder="{{ __('Name of product') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="description">
                                    <b class="text-danger">*</b>
                                    {{ __('Description') }}:</label>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <textarea type="text" class="form-control" id="description" name="description"
                                                  placeholder="{{ __('Description') }}"
                                                  required="">{{ $item->description }} </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="price">
                                    <b class="text-danger">*</b>
                                    {{ __('Price') }}:</label>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <input type="number" class="form-control" id="price" name="price"
                                               value="{{ $item->price }}" placeholder="{{ __('Price') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">₽</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="category_id">{{ __('Category') }}:</label>
                                <span class="form-note">{{ __('Optional field') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <select class="form-select" id="category_id" name="category_id">
                                        <option value="0" selected>{{ __('Select a category') }}</option>
                                        @if(count($categories) > 0)
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"
                                                        @if($item->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="issuance_command">
                                    <b class="text-danger">*</b>
                                    {{ __('Issuance command') }}:</label>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <textarea type="text" class="form-control" id="issuance_command"
                                                  name="issuance_command"
                                                  placeholder="{{ __('Issuing commands. Each command on a new line. Commands are entered without /') }}"
                                                  required="">{{ $item->issuance_command }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="withdraw_command">{{ __('Withdraw command') }}:</label>
                                <span class="form-note">{{ __('Optional field') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <div class="input-group">
                                        <textarea type="text" class="form-control" id="withdraw_command"
                                                  name="withdraw_command"
                                                  placeholder="{{ __('Privilege withdrawal commands. Each command on a new line. Commands are entered without /. Leave blank if not needed') }}">{{ $item->withdraw_command }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label"
                                       for="withdraw_command_timeout">{{ __('Timeout for execution of withdrawal commands') }}
                                    :</label>
                                <span class="form-note">{{ __('Optional field') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="withdraw_command_timeout"
                                           name="withdraw_command_timeout" value="{{ $item->withdraw_command_timeout }}"
                                           placeholder="{{ __('The time after which the execution of command privilege withdrawal occurs (in days)') }}">
                                    <div class="button-small-container mt-2 d-block">
                                        <span class="button-small timeout_days_help"
                                              data-time="1">{{ __('Day') }}</span>
                                        <span class="button-small timeout_days_help"
                                              data-time="7">{{ __('A week') }}</span>
                                        <span class="button-small timeout_days_help"
                                              data-time="30">{{ __('1 month') }}</span>
                                        <span class="button-small timeout_days_help"
                                              data-time="90">{{ __('3 months') }}</span>
                                        <span class="button-small timeout_days_help"
                                              data-time="180">{{ __('6 months') }}</span>
                                        <span class="button-small timeout_days_help"
                                              data-time="365">{{ __('1 year') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="position">{{ __('Position') }}:</label>
                                <span class="form-note">{{ __('The higher the position, the first the product is displayed on the shop page') }}</span>
                                <span class="form-note">{{ __('Optional field') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" id="position" name="position"
                                           value="{{ $item->position }}" placeholder="{{ __('Position') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="image">{{ __('Product visibility in the shop') }}
                                    :</label>
                            </div>
                        </div>
                        <div class="col-lg-8 d-flex align-center">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" @if($item->active) checked
                                       @endif id="active" name="active">
                                <label class="custom-control-label" for="active"></label>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-center">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-label" for="image">{{ __('Product picture') }}:</label>
                                <span class="form-note">{{ __('Optional field') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-7 d-flex  align-center">
                            <div class="form-group">
                                <div class="user-avatar sq xl">
                                    <img src="{{ asset($item->image) }}" id="product_image" alt="">
                                </div>
                                <div class="form-control-wrap d-block mt-3">
                                    <input type="file" id="image" name="image" accept="image/*">

                                    <div class="form-group">
                                        <input type="hidden" value="" id="image_delete" name="image_delete"/>
                                        <div class="btn btn-light mt-1" id="product_image_delete">
                                            {{ __('Delete') }}
                                        </div>
                                    </div>
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
