<?php

namespace App\Http\Services\Tickets;

use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ServiceCreate
{

    public function handle($params)
    {
        $req = Validator::make($params, [
            'category' => 'required|string',
            'priority' => 'required|string',
            'title' => 'required|string',
        ]);
        if ($req->fails()) {
            return response()->json([
                "status" => false,
                "errors" => $req->errors()->toJson()
            ], 200);
        }
        try {
            $ticket = Ticket::create([
                'user_id' => Auth::user()->id,
                'category' => $params['category'],
                'priority' => $params['priority'],
                'title' => $params['title']
            ]);
            return response()->json([
                "status" => true,
                "redirect" => route('tickets.show', ['id' => $ticket->id])
            ]);
        } catch (ValidationException $e) {
            return response()->json(["message" => "Oops.. Something went wrong!"], 200);
        }
    }

}