<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function indexs()
    {
        $events = Event::with('competitors')->get();
        return view('events.indexs', compact('events'));
    }

    public function creates()
    {
        return view('events.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'competitors_id' => 'required|exists:competitors,id',
            'etime_range' => 'required|integer|max:10',
            'edistance' => 'required|string|max:100|alpha_num',
        ]);

        Event::create($validated);

        return redirect()->route('events.indexs')->with('Exito', 'Evento Agregado.');
    }

    public function shows(Event $event)
    {
        return view('events.shows', compact('event'));
    }

    public function edits(Event $event)
    {
        return view('events.edits', compact('event'));
    }

    public function updates(Request $request, Event $event)
    {
        $validated = $request->validate([
            'competitors_id' => 'required|exists:competitors,id',
            'etime_range' => 'required|integer|max:10',
            'edistance' => 'required|string|max:100|alpha_num',
        ]);

        $event->update($validated);

        return redirect()->route('events.indexs')->with('Exito', 'Evento Actualizado.');
    }

    public function destroys(Event $event)
    {
        $event->delete();

        return redirect()->route('events.indexs')->with('Exito', 'Evento Borrado.');
    }
    //API//
    // GET /events
    public function index()
    {
        $events = Event::all(); // Load competitor details with each event
        return response()->json($events);
    }

    // POST /events
    public function store(Request $request)
    {
        $validated = $request->validate([
            'competitors_id' => 'required|exists:competitors,id',
            'etime_range' => 'required|integer|max:10',
            'edistance' => 'required|string|max:100|alpha_num',
        ]);

        $event = Event::create($validated);
        return response()->json($event, 201);
    }

    // GET /events/{id}
    public function show($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }
        return response()->json($event);
    }

    // PUT /events/{id}
    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $validated = $request->validate([
            'competitors_id' => 'required|exists:competitors,id',
            'etime_range' => 'required|integer|max:10',
            'edistance' => 'required|string'
        ]);

        $event->update($validated);
        return response()->json(['message' => 'Event updated successfully', 'data' => $event]);
    }

    // DELETE /events/{id}
    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $event->delete();
        return response()->json(['message' => 'Event deleted successfully']);
    }
}
