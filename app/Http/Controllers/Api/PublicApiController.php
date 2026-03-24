<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SwimSession;
use App\Models\Ticket;

class PublicApiController extends Controller
{
    public function ticketStatus(string $code)
    {
        $ticket = Ticket::where('code', $code)->with('order')->first();

        if (!$ticket) {
            return response()->json(['status' => 'not_found', 'message' => 'Tiket tidak ditemukan.'], 404);
        }

        return response()->json([
            'status' => 'ok',
            'ticket' => [
                'code'          => $ticket->code,
                'ticket_status' => $ticket->status,
                'order_number'  => $ticket->order->order_number,
                'name'          => $ticket->order->name,
                'visit_date'    => $ticket->order->visit_date->format('d M Y'),
                'session'       => $ticket->order->session_label,
                'qty'           => $ticket->order->total_qty,
            ],
        ]);
    }

    public function sessions()
    {
        $sessions = SwimSession::where('is_active', true)
            ->orderBy('start_time')
            ->get(['id', 'name', 'start_time', 'end_time', 'price', 'quota']);

        return response()->json(['sessions' => $sessions]);
    }
}
