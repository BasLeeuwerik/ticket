<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Support\Facades\Request;

class TicketController extends Controller
{
    public function openIndex(Ticket $ticket)
    {
        $tickets = Ticket::query()
            ->orderByDesc('created_at')
            ->where('status', 'open')
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

    public function create()
    {
        return view('create-ticket');
    }

    public function store(Request $request)
    {
        $request->validate([
            'start_date_time' => 'required|date',
            'end_date_time' => 'required|date|after:start_date_time',
            'employee' => 'required|string',
            'note' => 'required|string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the validation rules as needed
        ]);
    
        $ticket = new Ticket;
    
        $ticket->start_date_time = $request->input('start_date_time');
        $ticket->end_date_time = $request->input('end_date_time');
        $ticket->employee = $request->input('employee');
        $ticket->note = $request->input('note');
    
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos');
            $ticket->photo = $photoPath;
        }
    
        $ticket->save();
    
        return redirect()->route('ticket.show', $ticket->id)->with('success', 'Ticket created successfully');
    }

    public function edit(Ticket $ticket, $id)
    {
        $ticket = Ticket::where('id', $id)->first();

        return view('edit-ticket', compact('id', 'ticket'));
    }

    public function update(Request $request,Ticket $id)
    {
        $request->validate([
            'start_date_time' => 'required|date',
            'end_date_time' => 'required|date|after:start_date_time',
            'name' => 'required|string',
            'note' => 'required|string',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $ticket = Ticket::findOrFail($id);

        $ticket->start_date_time = $request->input('start_date_time');
        $ticket->end_date_time = $request->input('end_date_time');
        $ticket->employee = $request->input('employee');
        $ticket->note = $request->input('note');

        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos');
            $ticket->photo = $photoPath;
        }

        $ticket->save();

        return view('show-ticket', [
            'ticket' => $ticket,
        ]);
    }
}
