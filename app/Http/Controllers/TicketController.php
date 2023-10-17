<?php

namespace App\Http\Controllers;

use App\Models\Material;
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

    public function create(User $user, Ticket $ticket, Material $material)
    {
        $users = User::all();
        $tickets = Ticket::all();
        $materials = Material::all();

        return view('create-ticket', compact('users', 'ticket', 'tickets', 'materials'));
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
            'material_name' => '',
            'material_quantity' => '',
        ]);

        if ($request->file('image') == null) {
            $file = "";
        } else {
            $file = $request->file('image')->store('image');
        }

        $ticket = new Ticket;
        $ticket->start_date_time = $validated->start_date_time;
        $ticket->end_date_time = $validated->end_date_time;
        $ticket->user_id = $validated->user_id;
        $ticket->comment = $validated->comment;
        $ticket->image = $file;
        $ticket->status = 'open';
        $ticket->save();

        $materialNames = $request->input('material_name');

        foreach ($materialNames as $index => $materialName) {
            $ticket->materials()->create([
                'material_name' => $materialName,
                'material_quantity' => $request->input('material_quantity')[$index],
                'ticket_id' => $ticket->id,
            ]);
        }

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
            'start_date_time' => 'required',
            'end_date_time' => '',
            'user_id' => 'required',
            'status' => '',
            'comment' => '',
            'image' => '',
            'material_name.*' => '',
            'material_quantity.*' => '',
        ]);

        if ($request->file('image') == null) {
            $file = "";
        } else {
            $file = $request->file('image')->store('image');
        }

        $ticket->start_date_time = $validated->start_date_time;
        $ticket->end_date_time = $validated->end_date_time;
        $ticket->user_id = $validated->user_id;
        $ticket->comment = $validated->comment;
        $ticket->image = $file;
        $ticket->status = $validated->status;
        $ticket->user_id = $validated->user_id;
        $ticket->status = $validated->status;
        $ticket->comment = $validated->comment;
        $ticket->save();

        $materialNames = $request->input('material_name');

        $ticket->materials()->delete();

        foreach ($materialNames as $index => $materialName) {
            $ticket->materials()->create([
                'material_name' => $materialName,
                'material_quantity' => $request->input('material_quantity')[$index],
                'ticket_id' => $ticket->id,
            ]);
        }

        $ticket->save();

        return to_route('ticket.show', ['ticket' => $ticket->id]);
    }
}
