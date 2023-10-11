<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;

class TicketController extends Controller
{
    public function openIndex(Ticket $ticket)
    {
        $tickets = Ticket::query()
            ->orderByDesc('created_at')
            ->where('status', 'open')
            ->orWhere('status', 'paid')
            ->with('user')
            ->paginate(10);

        return view('open-tickets', [
            'tickets' => $tickets,
        ]);
    }

    public function closedIndex(Ticket $ticket)
    {
        $tickets = Ticket::query()
            ->orderByDesc('created_at')
            ->where('status', 'closed')
            ->orWhere('status', 'completed')
            ->with('user')
            ->paginate(10);

        return view('closed-tickets', [
            'tickets' => $tickets,
        ]);
    }

    public function show($id)
    {
        $ticket = Ticket::where('id', $id)->first();

        return view('show-ticket', compact('ticket'));
    }
}
