<?php

namespace App\Http\Controllers\App\Tickets;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{

    public function index() {
        $tickets = Auth()->user()->tickets()->orderBy('created_at', 'desc')->paginate(10);

        return view('pages.tickets.index', ['tickets' => $tickets]);
    }

    public function show($id) {
        $query = Ticket::where('user_id', Auth::user()->id)->where('id', $id);
        $ticket = $query->first();
        if(!$ticket) {
            return redirect()->route('tickets.index');
        }
        $query->update(['new' => 0, 'reply' => 0]);
        $messages = $ticket->messages()->get();
        return view('pages.tickets.show', ['ticket' => $ticket, 'messages' => $messages]);
    }

    public function close($id) {
        $query = Ticket::where('user_id', Auth::user()->id)->where('id', $id);
        $ticket = $query->first();
        if(!$ticket) {
            return redirect()->route('tickets.index');
        }
        $query->update(['closed' => 1, 'new' => 0, 'reply' => 0]);
        return redirect()->route('tickets.show', ['id' => $id]);
    }

    public function create(Request $request) {
        if($request->isMethod('post')) {
            return (new \App\Http\Services\Tickets\ServiceCreate)->handle($request->all());
        }
        return view('pages.tickets.create');
    }

    public function sendMessage(Request $request, $id) {
        if($request->isMethod('post')) {
            return (new \App\Http\Services\Tickets\ServiceSendMessage)->handle($id, $request->all());
        }
    }

}
