<?php

namespace App\Http\Controllers;

use App\Models\competition;
use Illuminate\Http\Request;

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
        return view('competitions.creates');
    }

    // Store a newly created competition in storage.
    public function stores(Request $request)
    {
        $messages = [
            'cplace.regex' => 'El campo :attribute solo puede contener letras y espacios.',
        ];

        $request->validate([
            'cname' => 'required|string|max:100|alpha',
            'cdate' => 'required|date',
            'ctime' => 'required|date_format:H:i',
            'cplace' => 'required|string|max:50|regex:/^[\pL\s]*$/u',
        ], $messages);

        competition::create($request->all());

        return redirect()->route('competitions.indexs')->with('Exito', 'Competencia creada.');
    }

    // Display the specified competition.
    public function shows(competition $competition)
    {
        return view('competitions.shows', compact('competition'));
    }

    // Show the form for editing the specified competition.
    public function edits(competition $competition)
    {
        return view('competitions.edits', compact('competition'));
    }

    // Update the specified competition in storage.
    public function updates(Request $request, competition $competition)
    {
        $messages = [
            'cplace.regex' => 'El campo :attribute solo puede contener letras y espacios.',
        ];

        $request->validate([
            'cname' => 'required|string|max:100|alpha',
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
        $validated = $request->validate([
            'cname' => 'required|string',
            'cdate' => 'required|date',
            'ctime' => 'required|date_format:H:i:s',
            'cplace' => 'required|string'
        ]);

        $competition = Competition::create($validated);
        return response()->json($competition, 201);
    }

    // GET /competitions/{id}
    public function show($id)
    {
        $competition = Competition::find($id);
        if (!$competition) {
            return response()->json(['message' => 'Competition not found'], 404);
        }
        return response()->json($competition);
    }

    // PUT /competitions/{id}
    public function update(Request $request, $id)
    {
        $competition = Competition::find($id);
        if (!$competition) {
            return response()->json(['message' => 'Competition not found'], 404);
        }

        $validated = $request->validate([
            'cname' => 'required|string',
            'cdate' => 'required|date',
            'ctime' => 'required|date_format:H:i:s',
            'cplace' => 'required|string'
        ]);

        $competition->update($validated);
        return response()->json(['message' => 'Competition updated successfully', 'data' => $competition]);
    }

    // DELETE /competitions/{id}
    public function destroy($id)
    {
        $competition = Competition::find($id);
        if (!$competition) {
            return response()->json(['message' => 'Competition not found'], 404);
        }

        $competition->delete();
        return response()->json(['message' => 'Competition deleted successfully']);
    }
}
