<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\competition;
use App\Models\competitors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    public function indexs(Event $event)
    {
        $events = Event::with('competitors')->get();
        $competitors = competitors::with('user', 'competition');
        return view('Entrenador.Estrategia_de_Carreras.eventos_del_atleta', compact('events', 'competitors'));
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

        $competitor = Competitors::findOrFail($validated['competitors_id']);

        $event = new Event([
            'etime_range' => $validated['etime_range'],
            'edistance' => $validated['edistance'],
        ]);

        $competitor->event()->save($event);

        //Event::create($validated);

        return redirect()->route('events.indexs')->with('Exito', 'Evento Agregado.');
    }

    public function compshows($id)
    {
        // Fetch the competitor and related models, order the events by the numeric part of 'edistance'
        $competitor = Competitors::with([
            'competition',
            'users',
            'events' => function($query) {
                // Extract numbers from 'edistance' and order by these values ascending
                $query->orderByRaw("CAST(SUBSTRING(edistance, 1, LENGTH(edistance) - 1) AS UNSIGNED) ASC");
            }
        ])->findOrFail($id);

        // Get all events, potentially for other uses not ordered
        $event = Event::with('competitors')->get();

        // Return the view with ordered events under the competitor
        return view('Entrenador.Estrategia_de_Carreras.eventos_del_atleta', compact('competitor', 'event'));
    }



    public function asignarEvento(Request $request, $id) {
        //$this->authorize('assignAthlete', competitors::class);
        //$events = Event::findOrFail($request->events_id);
        $competitor = competitors::findOrFail($id);
        $validated = $request->validate([
            'etime_range' => 'required|max:10000',
            'edistance' => 'required|string|max:20|min:4',
        ]);

        $timeParts = explode(':', $validated['etime_range']);
        $totalSeconds = (int)$timeParts[0] * 60 + (int)$timeParts[1];

        $event = new Event([
            'competitors_id' => $competitor->id,
            'etime_range' => $totalSeconds,
            'edistance' => $validated['edistance'],
        ]);

       // $competitors->event()->attach($events);
        $competitor->events()->save($event);

        return back()->with('Exito', 'Añadido exitosamente.');
    }

    public function storeEvents(Request $request, $id) {
        $competitor = Competitors::findOrFail($id);

    foreach ($request->events as $event) {
        $timeParts = explode(':', $event['etime_range']);
        $totalSeconds = (int)$timeParts[0] * 60 + (int)$timeParts[1];

        Event::create([
            'competitors_id' => $competitor->id,
            'etime_range' => $totalSeconds,
            'edistance' => $event['edistance'],
        ]);
    }

    return back()->with('Exito', 'Eventos añadidos exitosamente.');
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

        return back()->with('Exito', 'Evento Eliminado.');
    }

    public function atheltedestroy(competitors $competitor)
    {
        // If the relationship is correctly defined, you can directly access the competition_id attribute
        $competitionId = $competitor->competition_id;

        // Delete the competitor
        $competitor->delete();

        // Redirect to the specific competition's list of athletes, passing the competition ID
        return redirect()->route('competition.listatleta', ['id' => $competitionId])->with('Exito', 'Competidor Eliminado.');
    }


    public function splittableatleta($id){
        $competitor = Competitors::with([
            'competition',
            'users',
            'events' => function($query) {
                // Extract numbers from 'edistance' and order by these values ascending
                $query->orderByRaw("CAST(SUBSTRING(edistance, 1, LENGTH(edistance) - 1) AS INTEGER) ASC");
            }
        ])->findOrFail($id);


        $events = $competitor->events->map(function ($event) {
            return [
                'distance' => preg_replace('/[^0-9]/', '', $event->edistance),
                'time' => $event->etime_range
            ];
        })->toJson(); // Convert the collection to JSON here in the controller

    return view('Entrenador.Estrategia_de_Carreras.ver_split_table_atleta', compact('competitor', 'events'));
    }


    public function splittablegeneral($id){
    $competitors = Competitors::with(['users', 'events'=> function($query) {
        // Extract numbers from 'edistance' and order by these values ascending
        $query->orderByRaw("CAST(SUBSTRING(edistance, 1, LENGTH(edistance) - 1) AS INTEGER) ASC");
    }
]
)->where('competition_id', $id)->get();
    $allEvents = collect();
    $competition = competition::FindorFail($id);

    $competition = competition::FindorFail($id);

    foreach ($competitors as $competitor) {
        foreach ($competitor->events as $event) {
            $allEvents->push([
                'name' => $competitor->users->first_name . ' ' . $competitor->users->last_name,
                'distance' => preg_replace('/[^0-9]/', '', $event->edistance),
                'time' => $event->etime_range
            ]);
        }
    }

    $eventsJson = $allEvents->toJson();
    $eventsAreEmpty = $allEvents->isEmpty();

    $eventsJson = $allEvents->toJson();
    return view('Entrenador.Estrategia_de_Carreras.ver_split_table_general', [
        'competitors' => $competitors,
        'eventsJson' => $eventsJson,
        'competition' => $competition,
        'eventsAreEmpty' => $eventsAreEmpty // Pass this to the view
    ]);
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
