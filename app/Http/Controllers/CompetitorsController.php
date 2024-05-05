<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\competitors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompetitorsController extends Controller
{
    public function indexs()
    {
        $competitors = competitors::with(['users', 'competition'])->get();
        return view('competitors.indexs', compact('competitors'));
    }

    public function creates()
    {
        // You may need to pass users and competitions to your view for selection
        return view('competitors.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'users_id' => 'required|exists:users,id',
            'competition_id' => 'required|exists:competition,id',
        ]);

        competitors::create($validated);
        return redirect()->route('competitors.indexs')->with('Exito', 'Competidor creado.');
    }

    public function shows(competitors $competitor)
    {
        $events = Event::with('competitors')->get();
        $competitors = competitors::with('user', 'competition');
        return view('Entrenador.Estrategia_de_Carreras.eventos_del_atleta', compact('competitors', 'events'));
    }

    public function assignarAtleta(Request $request) {
        $this->authorize('assignAthlete', Competitors::class);  // Ensure only coaches can perform this action

        $competitionId = $request->competitors_id;
        $userId = $request->users_id; // ID of the athlete

        $competition = Competitors::find($competitionId);
        $user = User::find($userId);

        if (!$competition || !$user) {
            return back()->with('error', 'Invalida competencia o atleta.');
        }

        // Attach the athlete to the competition
        $competition->users()->attach($userId);

        return back()->with('Exito', 'Atleta asignado a una competencia exitosamente.');
    }

    public function edits(Competitors $competitor)
    {
        // Pass the competitor along with users and competitions to your view
        return view('competitors.edits', compact('competitor'));
    }

    public function updates(Request $request, Competitors $competitor)
    {
        $validated = $request->validate([
            'users_id' => 'required|exists:users,id',
            'competition_id' => 'required|exists:competition,id',
        ]);

        $competitor->update($validated);
        return redirect()->route('competitors.indexs')->with('Exito', 'Competidor actualizado.');
    }

    public function destroys(Competitors $competitor)
    {
        $competitor->delete();
        return redirect()->route('competitors.indexs')->with('Exito', 'Competidor Borrado.');
    }
    //API//
    // GET /competitors
    public function index()
    {
        $competitors = Competitors::all();  // Assuming you want to load related user and competition data
        return response()->json($competitors);
    }

    // POST /competitors
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
           'users_id' => 'required|exists:users,id',
            'competition_id' => 'required|exists:competition,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $am = new competitors([
            'users_id' => $validated['users_id'],
            'competition_id' => $validated['competition_id'],
        ]);

        $am->save();

        return response()->json("Added", 201);
    }

    // GET /competitors/{id}
    public function show($id)
    {
        $competitor = Competitors::find($id);
        if (!$competitor) {
            return response()->json(['message' => 'Competitor no se encontro'], 404);
        }
        return response()->json($competitor);
    }

    // PUT /competitors/{id}
    public function update(Request $request, competitors $amre, $id)
     {
        $amre = competitors::find($id);
        if (!$amre) {
            return response()->json(['message' => 'Competidores no se encontro'], 404);
        }

        $validator = Validator::make($request->all(),[
            'users_id' => 'required|exists:users,id',
            'competition_id' => 'required|exists:competition,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $amre->update([
            'users_id' => $validated['users_id'],
            'competition_id' => $validated['competition_id'],
        ]);

        return response()->json(['message' => 'Competidores actualizado', 'data' => $amre]);
     }

    // DELETE /competitors/{id}
    public function destroy($id)
    {
        $competitor = Competitors::find($id);
        if (!$competitor) {
            return response()->json(['message' => 'Competitor no se encontro'], 404);
        }

        $competitor->delete();
        return response()->json(['message' => 'Competitor eliminado']);
    }
}
