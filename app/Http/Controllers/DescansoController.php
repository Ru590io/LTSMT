<?php

namespace App\Http\Controllers;

use App\Models\descanso;
use Illuminate\Http\Request;

class DescansoController extends Controller
{
    public function indexs()
    {
        $descansos = descanso::all();
        return view('descansos.indexs', compact('descansos'));
    }

    public function creates()
    {
        return view('descansos.creates');
    }

    public function stores(Request $request)
    {
        $request->validate([
            'ddescanso' => 'required|string|in:Descanso|max:8',
        ]);

        Descanso::create($request->all());

        return redirect()->route('descansos.indexs')->with('Exito', 'Descanso Agregado.');
    }

    public function shows(Descanso $descanso)
    {
        return view('descansos.shows', compact('descanso'));
    }

    public function edits(Descanso $descanso)
    {
        return view('descansos.edits', compact('descanso'));
    }

    public function updates(Request $request, Descanso $descanso)
    {
        $request->validate([
            'ddescanso' => 'required|string|in:Descanso|max:8',
        ]);

        $descanso->update($request->all());

        return redirect()->route('descansos.indexs')->with('Exito', 'Descanso Actualizado.');
    }

    public function destroys(Descanso $descanso)
    {
        $descanso->delete();

        return redirect()->route('descansos.indexs')->with('Exito', 'Descanso Borrado.');
    }
    //API//
    public function index()
    {
        $descansos = Descanso::all();
        return response()->json($descansos);
    }

    // POST /descansos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ddescanso' => 'required|string'
        ]);

        $descanso = Descanso::create($validated);
        return response()->json($descanso, 201);
    }

    // GET /descansos/{id}
    public function show($id)
    {
        $descanso = Descanso::find($id);
        if (!$descanso) {
            return response()->json(['message' => 'Descanso not found'], 404);
        }
        return response()->json($descanso);
    }

    // PUT /descansos/{id}
    public function update(Request $request, $id)
    {
        $descanso = Descanso::find($id);
        if (!$descanso) {
            return response()->json(['message' => 'Descanso not found'], 404);
        }

        $validated = $request->validate([
            'ddescanso' => 'required|string'
        ]);

        $descanso->update($validated);
        return response()->json(['message' => 'Descanso updated successfully', 'data' => $descanso]);
    }

    // DELETE /descansos/{id}
    public function destroy($id)
    {
        $descanso = Descanso::find($id);
        if (!$descanso) {
            return response()->json(['message' => 'Descanso not found'], 404);
        }

        $descanso->delete();
        return response()->json(['message' => 'Descanso deleted successfully']);
    }
}
