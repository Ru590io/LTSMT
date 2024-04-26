<?php

namespace App\Http\Controllers;

use App\Models\competitors;
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
            'etime_range' => 'required|integer|max:10000',
            'edistance' => 'required|string|max:20|min:4|alpha_num',
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
            'etime_range' => 'required|integer|max:10000',
            'edistance' => 'required|string|max:20|min:4|alpha_num',
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
        $competitorExists = competitors::find($request->competitors_id);

        if (!$competitorExists) {
            return response()->json(['message' => 'No se encontro ningun competidor para este entrenamiento'], 404);
        }
        $validator = Validator::make($request->all(),[
            'competitors_id' => 'required|exists:competitors,id',
            'etime_range' => 'required|integer|max:10000',
            'edistance' => 'required|string|max:20|min:4|alpha_num',
         ]);

         //$timeInSeconds = $request->etime_range * 60;

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
            return response()->json(['message' => 'Evento no se encontro'], 404);
        }
        return response()->json($event);
    }

    // PUT /events/{id}
    public function update(Request $request, Event $amre, $id)
    {
        $competitorExists = competitors::find($request->competitors_id);

        if (!$competitorExists) {
            return response()->json(['message' => 'No se encontro ningun competidor para este entrenamiento'], 404);
        }
       $amre = Event::find($id);
       if (!$amre) {
           return response()->json(['message' => 'Evento no se encontro'], 404);
       }

       $validator = Validator::make($request->all(),[
        'competitors_id' => 'required|exists:competitors,id',
        'etime_range' => 'required|integer|max:10000',
        'edistance' => 'required|string|max:20|min:4|alpha_num',
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

       return response()->json(['message' => 'Evento actualizado', 'data' => $amre]);
    }

    // DELETE /events/{id}
    public function destroy($id)
    {
        $event = Event::find($id);
        if (!$event) {
            return response()->json(['message' => 'Evento no se encontro'], 404);
        }

        $event->delete();
        return response()->json(['message' => 'Evento eliminado']);
    }
}
