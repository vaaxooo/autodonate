@extends('layouts.app')
@section('title', __('Support Ticket'))

@section('content')

    <div class="nk-block-head">
        <div class="nk-block-between-md g-4">
            <div class="nk-block-head-content">
                <h2 class="nk-block-title fw-normal">{{ __('Support Ticket') }}</h2>
                <div class="nk-block-des text-soft">
                    <p>{{ __('You have total :count', ['count' => $tickets->total()])." ".trans_choice('ticketsFormat', $tickets->total()) }}</p>
                </div>
            </div>
            <div class="nk-block-head-content">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="{{ route('tickets.create') }}" class="btn btn-icon btn-success">
                            <em class="icon ni ni-plus"></em>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    <div class="nk-block">
        <div class="card shadow">
            <table class="table table-tickets">
                <thead class="tb-ticket-head">
                <tr class="tb-ticket-title">
                    <th class="tb-ticket-id">
                        <span>{{ __('Ticket') }}</span>
                    </th>
                    <th class="tb-ticket-desc">
                        <span>{{ __('Subject') }}</span>
                    </th>
                    <th class="tb-ticket-status">
                        <span>{{ __('Priority') }}</span>
                    </th>
                    <th class="tb-ticket-date tb-col-md">
                        <span>{{ __('Submitted') }}</span>
                    </th>
                    <th class="tb-ticket-status">
                        <span>{{ __('Status') }}</span>
                    </th>
                    <th class="tb-ticket-action"> &nbsp;</th>
                </tr>
                </thead>
                <tbody class="tb-ticket-body">
                @if(count($tickets) > 0)
                    @foreach($tickets as $ticket)
                        <tr class="tb-ticket-item @if($ticket->new || $ticket->reply) is-unread @endif">
                            <td class="tb-ticket-id">
                                <a href="{{ route('tickets.show', ['id' => $ticket->id]) }}">#{{ $ticket->id }}</a>
                            </td>
                            <td class="tb-ticket-desc">
                                <a href="{{ route('tickets.show', ['id' => $ticket->id]) }}">
                                    <span class="title">{{ $ticket->title }}</span>
                                </a>
                            </td>
                            <td class="tb-ticket-status">
                                <span class="badge badge-light">{{ __($ticket->priority) }}</span>
                            </td>
                            <td class="tb-ticket-date tb-col-md">
                                <span class="date">{{ $ticket->created_at }}</span>
                            </td>
                            <td class="tb-ticket-status">
                                @if($ticket->closed)
                                    <span class="text-danger fw-bold">{{ __('Closed') }}</span>
                                @else
                                    <span class="text-success fw-bold">{{ __('Open') }}</span>
                                @endif
                            </td>
                            <td class="tb-ticket-action">
                                <a href="{{ route('tickets.show', ['id' => $ticket->id]) }}"
                                   class="btn btn-icon btn-trigger">
                                    <em class="icon ni ni-chevron-right"></em>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>
    </div>

    @include('components.app.partials.pagination', ['action' => $tickets])
@endsection