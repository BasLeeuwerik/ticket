<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
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
        return view('create-ticket', 'users');
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
    
        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket created successfully');
    }

    public function edit(User $user, Ticket $ticket)
    {
        $users = User::all();

        // dd($users);

        $tickets = Ticket::all();

        $ticket = Ticket::where('id', $ticket->id)->first();

        $user = User::where('id', $ticket->user_id)->first();

        $selectedUser = $user;

        return view('edit-ticket', compact('ticket', 'users', 'user', 'selectedUser'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->start_date_time = $request->input('start_date_time');
        $ticket->end_date_time = $request->input('end_date_time');
        $ticket->name = $request->input('name');
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
