<?php

namespace App\Http\Services\Tickets;

use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ServiceSendMessage
{

    public function handle($ticket_id, $params)
    {
        $req = Validator::make($params, [
            'message' => 'required|string|min:10|max:5000',
        ]);
        if ($req->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
            ], 200);
        }
        try {
            $ticket = TicketMessage::create([
                'ticket_id' => $ticket_id,
                'sender' => Auth::user()->id,
                'message' => $params['message']
            ]);
            return response()->json([
                "status" => true,
                "redirect" => route('tickets.show', ['id' => $ticket_id])
            ]);
        } catch (ValidationException $e) {
            return response()->json(["message" => "Oops.. Something went wrong!"], 200);
        }
    }

}