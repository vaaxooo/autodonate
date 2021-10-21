@extends('layouts.app')
@section('title', __('New request'))

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{ __('How can we help?') }}</h2>
                <div class="nk-block-des text-soft">
                    <p>{{ __('You can find all the questions and answers on our website') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-2" id="message"></div>
    <div class="mb-2" id="errors"></div>

    <div class="nk-block shadow mb-3">
        <div class="card">
            <div class="card-inner">
                <form action="{{ route('tickets.create') }}" method="POST" class="form-contact">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span>{{ __('Category') }}</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-select" data-search="off" data-ui="lg" id="category" name="category">
                                        <option value="General">{{ __('General') }}</option>
                                        <option value="Billing">{{ __('Billing') }}</option>
                                        <option value="Technical">{{ __('Technical') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- .col -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><span>{{ __('Priority') }}</span></label>
                                <div class="form-control-wrap">
                                    <select class="form-select" data-search="off" data-ui="lg" id="priority" name="priority">
                                        <option value="Normal">{{ __('Normal') }}</option>
                                        <option value="Important">{{ __('Important') }}</option>
                                        <option value="High Priority">{{ __('High Priority') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- .col -->
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form-label">{{ __('Briefly describe your problem') }}</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control form-control-lg" placeholder="{{ __('Write your problem...') }}" id="title" name="title" required>
                                </div>
                            </div>
                        </div><!-- .col -->
                        <div class="col-12">
                            <button class="btn btn-success">{{ __('Continue') }}</button>
                        </div><!-- .col -->
                    </div><!-- .row -->
                </form><!-- .form-contact -->
            </div><!-- .card-inner -->
        </div><!-- .card -->
    </div><!-- .nk-block -->



@endsection
