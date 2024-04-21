<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

    public function shows(Event $event, $id)
    {
        $item = Event::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para ver.');
        }
        return view('events.shows', compact('event'));
    }

    public function edits(Event $event, $id)
    {
        $item = Event::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para editar.');
        }
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
        $validator = Validator::make($request->all(),[
            'competitors_id' => 'required|exists:competitors,id',
            'etime_range' => 'required|integer|max:10',
            'edistance' => 'required|string|max:100|alpha_num',
         ]);

         if ($validator->fails()) {
             return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
         }

         $validated = $validator->validated();
         $am = new Event([
            'competitors_id' => $validated['competitors_id'],
            'etime_range' => $validated['etime_range'],
            'edistance' => $validated['edistance'],
         ]);

         $am->save();

         return response()->json("Added", 201);
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
    public function update(Request $request, Event $amre, $id)
    {
       $amre = Event::find($id);
       if (!$amre) {
           return response()->json(['message' => 'Evento not found'], 404);
       }

       $validator = Validator::make($request->all(),[
        'competitors_id' => 'required|exists:competitors,id',
        'etime_range' => 'required|integer|max:10',
        'edistance' => 'required|string|max:100|alpha_num',
       ]);

       if ($validator->fails()) {
           return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
       }

       $validated = $validator->validated(); // Get validated data array

       $amre->update([
        'competitors_id' => $validated['competitors_id'],
        'etime_range' => $validated['etime_range'],
        'edistance' => $validated['edistance'],
       ]);

       return response()->json(['message' => 'Evento updated successfully', 'data' => $amre]);
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
