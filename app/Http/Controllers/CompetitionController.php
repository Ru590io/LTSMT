<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Event;
use App\Models\competition;
use App\Models\competitors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompetitionController extends Controller
{
    // Display a listing of the competition.
    public function competitionlist()
    {
        $competitions = competition::orderBy('id', 'asc')->orderBy('cname', 'asc')->orderBy('ctime', 'asc')->get(['id','cname', 'ctime']);

        return view('Entrenador.Estrategia_de_Carreras.estrategia_de_carreras_general', compact('competitions'));
    }

    // Show the form for creating a new competition.
    /*public function creates()
    {
        return view('Entrenador.Estrategia_de_Carreras.estrategia_de_carreras_general');
    }*/

    public function addindex(){
        return view('Entrenador.Estrategia_de_Carreras.crear_nueva_competencia_estrategia_de_carreras');
    }

    // Store a newly created competition in storage.
    public function stores(Request $request)
    {
        $messages = [
            /*'cplace.regex' => 'El campo :attribute solo puede contener letras y espacios.',
            'cname.regex' => 'El campo :attribute solo puede contener letras y espacios.'*/
        ];
        /*regex:/^[\pL\s]*$/u
        regex:/^[\pL\s]*$/u*/
        $validatedData = $request->validate([
            'cname' => 'required|string|max:100',
            'cdate' => 'required|date',
            'ctime' => 'required|date_format:H:i',
            'cplace' => 'required|string|max:255',
        ], $messages);

        $convertedTime = Carbon::createFromFormat('H:i', $request->ctime)->format('H:i:s');
        $validatedData['ctime'] = $convertedTime;
        competition::create($validatedData);

        return redirect()->route('competition.list')->with('Exito', 'Competencia creada.');
    }

    // Display the specified competition.
    public function shows(competition $competition)
    {
        $competitors = Competitors::with('competition', 'users', 'events')->get('id');
        $competitions = competition::get();
        $competition->ctime = Carbon::createFromFormat('H:i:s', $competition->ctime)->format('h:i A');
    return view('Entrenador.Estrategia_de_Carreras.detalles_de_la_competencia_general', compact('competition', 'competitors', 'competitions'));
    }

    // Show the form for editing the specified competition.
    public function edits(competition $competition)
    {
        //$competition = competition::orderBy('id', 'asc')->orderBy('cname', 'asc')->orderBy('ctime', 'asc')->get(['id','cname', 'ctime']);
        $competition->ctime = Carbon::createFromFormat('H:i:s', $competition->ctime)->format('h:i A');
        return view('Entrenador.Estrategia_de_Carreras.editar_detalles_de_la_competencia', compact('competition'));
    }


    // Update the specified competition in storage.
    public function updates(Request $request, competition $competition)
    {
        $messages = [
           /* 'cplace.regex' => 'El campo :attribute solo puede contener letras y espacios.',
            'cname.regex' => 'El campo :attribute solo puede contener letras y espacios.'*/
        ];

        $validatedData= $request->validate([
            'cname' => 'required|string|max:100',
            'cdate' => 'required|date',
            'ctime' => 'required|date_format:H:i',
            'cplace' => 'required|string|max:255',
        ], $messages);

        $convertedTime = Carbon::createFromFormat('H:i', $request->ctime)->format('H:i:s');
        $validatedData['ctime'] = $convertedTime;

        $competition->update($validatedData);

        return redirect()->route('competition.show', ['competition' => $competition->id])->with('Exito', 'Competencia Actualizada.');
    }

    // Remove the specified competition from storage.
    public function destroys(competition $competition)
    {
        //$competition->users()->detach();
        $competition->delete();
        return redirect()->route('competition.list')->with('Exito', 'Competencia Borrada.');
    }

    public function competitionshows($id)
    {
        $competitors = Competitors::with('competition', 'users', 'events')->where('competition_id', $id)->get();
        $competition = Competition::with('users')->findOrFail($id);
        //$competition = Competition::with('users')->get();
        $users = User::where('role', 'Atleta')->get();
    return view('Entrenador.Estrategia_de_Carreras.lista_de_competidores', compact('competition', 'users', 'competitors'));
    }

    /*public function compshows($id)
    {
        $competitor = Competitors::with(['events'])->findOrFail($id);
        return view('Entrenador.Estrategia_de_Carreras.eventos_del_atleta', compact('competitor'));
    }*/

    public function assignarAtleta(Request $request) {
        $this->authorize('assignAthlete', Competition::class);  // Ensure only coaches can perform this action
        $competition = Competition::findOrFail($request->competition_id);
        $user = User::findOrFail($request->users_id);

        if (!$competition->users()->where('users_id', $user->id)->exists()) {
            $competition->users()->attach($user);
            return back()->with('Exito', 'Atleta asignado a la competencia exitosamente.');
        }

        return back()->with('error', 'El atleta ya está asignado a esta competencia.');
    }


    //API//
    // GET /competitions
    public function indexs()
    {
        $competitions = Competition::all();
        return response()->json($competitions);
    }

    // POST /competitions
    public function store(Request $request)
    {
         $messages = [
            'cplace.regex' => 'El campo :attribute solo puede contener letras y espacios.',
            'cname.regex' => 'El campo :attribute solo puede contener letras y espacios.'
        ];
        $validator = Validator::make($request->all(),[
            'cname' => 'required|string|max:30|regex:/^[\pL\s]*$/u',
            'cdate' => 'required|date',
            'ctime' => 'required|date_format:h:i A',
            'cplace' => 'required|string|max:100|regex:/^[\pL\s]*$/u',
        ], $messages);

        $convertedTime = Carbon::createFromFormat('h:i A', $request->ctime)->format('H:i:s');

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $am = new competition([
            'cname' => $validated['cname'],
            'cdate' => $validated['cdate'],
            'ctime' => $convertedTime,
            'cplace' => $validated['cplace'],
        ]);

        $am->save();

        return response()->json("Added", 201);
    }

    // GET /competitions/{id}
    public function show($id)
    {
        $competition = Competition::find($id);
        if (!$competition) {
            return response()->json(['message' => 'Competencia no se encontro'], 404);
        }
        return response()->json($competition);
    }

    // PUT /competitions/{id}
    public function update(Request $request, competition $amre, $id)
     {
        $amre = competition::find($id);
        if (!$amre) {
            return response()->json(['message' => 'Competencia no se encontro'], 404);
        }

        $messages = [
            'cplace.regex' => 'El campo :attribute solo puede contener letras y espacios.',
            'cname.regex' => 'El campo :attribute solo puede contener letras y espacios.'
        ];

        $validator = Validator::make($request->all(),[
            'cname' => 'required|string|max:25|regex:/^[\pL\s]*$/u',
            'cdate' => 'required|date',
            'ctime' => 'required|date_format:h:i A',
            'cplace' => 'required|string|max:50|regex:/^[\pL\s]*$/u',
        ], $messages);

        $convertedTime = Carbon::createFromFormat('h:i A', $request->ctime)->format('H:i:s');

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $amre->update([
            'cname' => $validated['cname'],
            'cdate' => $validated['cdate'],
            'ctime' => $convertedTime,
            'cplace' => $validated['cplace'],
        ]);

        return response()->json(['message' => 'Competencia Actualizada', 'data' => $amre]);
     }

    // DELETE /competitions/{id}
    public function destroy($id)
    {
        $competition = Competition::find($id);
        if (!$competition) {
            return response()->json(['message' => 'Competencia no se encontro'], 404);
        }

        $competition->delete();
        return response()->json(['message' => 'Competencia eliminada exitosamente']);
    }
}
