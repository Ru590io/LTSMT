<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\competition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CompetitionController extends Controller
{
    // Display a listing of the competition.
    public function indexs()
    {
        $competitions = competition::all();
        return view('competitions.indexs', compact('competitions'));
    }

    // Show the form for creating a new competition.
    public function creates()
    {
        return view('Entrenador.Estrategia_de_Carreras.estrategia_de_carreras_general');
    }

    // Store a newly created competition in storage.
    public function stores(Request $request)
    {
        $messages = [
            'cplace.regex' => 'El campo :attribute solo puede contener letras y espacios.',
            'cname.regex' => 'El campo :attribute solo puede contener letras y espacios.'
        ];

        $request->validate([
            'cname' => 'required|string|max:100|regex:/^[\pL\s]*$/u',
            'cdate' => 'required|date',
            'ctime' => 'required|date_format:H:i',
            'cplace' => 'required|string|max:50|regex:/^[\pL\s]*$/u',
        ], $messages);

        competition::create($request->all());

        return redirect()->route('competitions.indexs')->with('Exito', 'Competencia creada.');
    }

    // Display the specified competition.
    public function shows(competition $competition, $id)
    {
        $item = competition::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para ver.');
        }
        return view('competitions.shows', compact('competition'));
    }

    // Show the form for editing the specified competition.
    public function edits(competition $competition, $id)
    {
        $item = competition::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para editar.');
        }
        return view('competitions.edits', compact('competition'));
    }

    // Update the specified competition in storage.
    public function updates(Request $request, competition $competition)
    {
        $messages = [
            'cplace.regex' => 'El campo :attribute solo puede contener letras y espacios.',
            'cname.regex' => 'El campo :attribute solo puede contener letras y espacios.'
        ];

        $request->validate([
            'cname' => 'required|string|max:100|regex:/^[\pL\s]*$/u',
            'cdate' => 'required|date',
            'ctime' => 'required|date_format:H:i',
            'cplace' => 'required|string|max:50|regex:/^[\pL\s]*$/u',
        ], $messages);

        $competition->update($request->all());

        return redirect()->route('competitions.indexs')->with('Exito', 'Competencia Actualizada.');
    }

    // Remove the specified competition from storage.
    public function destroys(competition $competition)
    {
        $competition->delete();
        return redirect()->route('competitions.indexs')->with('Exito', 'Competencia Borrada.');
    }
    //API//
    // GET /competitions
    public function index()
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
