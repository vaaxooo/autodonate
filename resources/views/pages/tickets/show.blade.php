@extends('layouts.app')
@section('title', $ticket->title)

@section('content')

    <div class="nk-block-head">

        <div class="nk-block-between-md g-4 align-items-end">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{ $ticket->title }}</h2>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-4 flex-wrap">
                    <li>
                        <a class="back-to" href="{{ route('tickets.index') }}">
                            <em class="icon ni ni-arrow-left"></em>
                            <span>{{ __('My Tickets') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div><!-- .nk-block-head -->
    <div class="nk-block">
        <div class="ticket-info">
            <ul class="ticket-meta">
                <li class="ticket-id">
                    <span>{{ __('Ticket') }}:</span>
                    <strong>#{{ $ticket->id }}</strong>
                </li>
                <li class="ticket-date">
                    <span>{{ __('Submitted') }}:</span>
                    <strong>{{ $ticket->created_at }}</strong>
                </li>
            </ul>
            <div class="ticket-status">
                @if($ticket->closed)
                    <span class="badge badge-danger">{{ __('Closed') }}</span>
                @else
                    <span class="badge badge-success">{{ __('Open') }}</span>
                @endif
            </div>
        </div>
    </div><!-- .nk-block -->
    <div class="nk-block">
        <div class="card shadow">
            <div class="card-inner">
                <div class="ticket-msgs">

                    @if(count($messages) > 0)
                        @foreach($messages as $message)
                            @if($sender = $message->sender()->first()) @endif
                            <div class="ticket-msg-item">
                                <div class="ticket-msg-from">
                                    <div class="ticket-msg-user user-card">
                                        <div class="user-avatar @if($message->sender == auth()->user()->id) bg-primary @else bg-warning @endif">
                                            <em class="icon ni ni-user-alt"></em>
                                        </div>
                                        <div class="user-info">
                                            <span class="lead-text">{{ $sender->fullname ? $sender->fullname : $sender->email }}</span>
                                            <span class="text-soft">@if($sender->admin || $sender->support) {{ __('Support Team') }} @else {{  __('Customer') }} @endif</span>
                                        </div>
                                    </div>
                                    <div class="ticket-msg-date">
                                        <span class="sub-text">{{ $message->created_at }}</span>
                                    </div>
                                </div>
                                <div class="ticket-msg-comment">
                                    <pre class="default-text">{{{ $message->message }}}</pre>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="ticket-msg-item">
                            <div class="ticket-msg-comment text-soft">
                                @if($ticket->closed)
                                        <strong>{{ __('There are no messages in this ticket..') }}</strong>
                                    @else
                                        <strong>{{ __('Please leave your question, suggestion or complaint in the box below!') }}</strong>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if(!$ticket->closed)
                        <div class="ticket-msg-reply">
                            <h5 class="title">{{ __('Reply') }}</h5>
                            <div class="mb-2" id="errors"></div>
                            <form action="{{ route('tickets.send_message', ['id' => $ticket->id]) }}" method="POST" class="form-reply" id="ticketSendMessageForm">
                                @csrf
                                <div class="form-group">
                                    <div class="form-editor-custom">
                                        <textarea class="form-control" placeholder="{{ __('Write a message...') }}" id="message" name="message"></textarea>
                                    </div>
                                </div>
                                <div class="form-action">
                                    <ul class="form-btn-group">
                                        <li class="form-btn-primary">
                                            <button class="btn btn-primary">{{ __('Send') }}</button>
                                        </li>
                                        <li class="form-btn-secondary">
                                            <a href="{{ route('tickets.close', ['id' => $ticket->id]) }}" class="btn btn-dim btn-outline-light">{{ __('Mark as closed') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div><!-- .nk-block -->



@endsection
