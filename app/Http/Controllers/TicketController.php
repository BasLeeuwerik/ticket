<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

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

    public function create(User $user, Ticket $ticket)
    {
        $users = User::all();

        $tickets = Ticket::all();

        return view('create-ticket', compact('users', 'ticket', 'tickets'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = (object)$request->validate([
            'start_date_time' => 'required',
            'end_date_time' => '',
            'user_id' => 'required',
            'status' => '',
            'comment' => '',
            'image' => '',
        ]);

        $imageUrl = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images', $imageName, 'public');
            $imageUrl = asset('storage/' . $imagePath);
        }

        $ticket = new Ticket;
        $ticket->start_date_time = $validated->start_date_time;
        $ticket->end_date_time = $validated->end_date_time;
        $ticket->user_id = $validated->user_id;
        $ticket->comment = $validated->comment;
        $ticket->image = $request->file('image')->store('image');
        $ticket->status = 'open';
        $ticket->save();
    
        return redirect()->route('ticket.show', $ticket->id)->with('success', 'Ticket created successfully');
    }

    public function edit(User $user, Ticket $ticket)
    {
        $users = User::all();

        $tickets = Ticket::all();

        return view('edit-ticket', compact('ticket', 'tickets', 'users', 'user'));
    }

    public function update(Request $request, Ticket $ticket): RedirectResponse
    {
        $validated = (object)$request->validate([
            'user_id' => 'required',
            'status' => 'required',
        ]);

        // $validated = (object)$request->validated();

        $ticket->user_id = $validated->user_id;
        $ticket->status = $validated->status;
        $ticket->save();


        return to_route('ticket.show', ['ticket' => $ticket->id]);
    }
}
