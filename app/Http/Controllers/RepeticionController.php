<?php

namespace App\Http\Controllers;

use App\Models\repeticiones;
use Illuminate\Http\Request;

class RepeticionController extends Controller
{
    public function indexs()
    {
        $repeticiones = repeticiones::all();
        return view('repeticions.indexs', compact('repeticions'));
    }

    public function creates()
    {
        return view('repeticions.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'Rdistancia' => 'required|string|max:100|alpha_num',
            'Rsets' => 'required|integer|max:10',
            'Rtiempoesperado' => 'required|integer|max:20',
            'Rrecuperacion' => 'required|integer|max:20',
        ]);

        Repeticiones::create($validated);
        return redirect()->route('repeticions.indexs')->with('Exito', 'Repeticion Creada');
    }

    public function shows(Repeticiones $repeticion)
    {
        return view('repeticions.shows', compact('repeticion'));
    }

    public function edits(Repeticiones $repeticion)
    {
        return view('repeticions.edits', compact('repeticion'));
    }

    public function updates(Request $request, Repeticiones $repeticion)
    {
        $validated = $request->validate([
            'Rdistancia' => 'required|string|max:100|alpha_num',
            'Rsets' => 'required|integer|max:10',
            'Rtiempoesperado' => 'required|integer|max:20',
            'Rrecuperacion' => 'required|integer|max:20',
        ]);

        $repeticion->update($validated);
        return redirect()->route('repeticions.indexs')->with('Exito', 'Repeticion Actualizada');
    }

    public function destroys(Repeticiones $repeticion)
    {
        $repeticion->delete();
        return redirect()->route('repeticions.indexs')->with('Exito', 'Repeticion Borrada');
    }
    //API//
    // GET /repeticions
    public function index()
    {
        $repeticiones = Repeticiones::all();
        return response()->json($repeticiones);
    }

    // POST /repeticions
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Rdistancia' => 'required|string',
            'Rsets' => 'required|integer',
            'Rtiempoesperado' => 'required|integer',
            'Rrecuperacion' => 'required|integer'
        ]);

        $repeticion = Repeticiones::create($validated);
        return response()->json($repeticion, 201);
    }

    // GET /repeticions/{id}
    public function show($id)
    {
        $repeticion = Repeticiones::find($id);
        if (!$repeticion) {
            return response()->json(['message' => 'Repeticion not found'], 404);
        }
        return response()->json($repeticion);
    }

    // PUT /repeticions/{id}
    public function update(Request $request, $id)
    {
        $repeticion = Repeticiones::find($id);
        if (!$repeticion) {
            return response()->json(['message' => 'Repeticion not found'], 404);
        }

        $validated = $request->validate([
            'Rdistancia' => 'required|string',
            'Rsets' => 'required|integer',
            'Rtiempoesperado' => 'required|integer',
            'Rrecuperacion' => 'required|integer'
        ]);

        $repeticion->update($validated);
        return response()->json(['message' => 'Repeticion updated successfully', 'data' => $repeticion]);
    }

    // DELETE /repeticions/{id}
    public function destroy($id)
    {
        $repeticion = Repeticiones::find($id);
        if (!$repeticion) {
            return response()->json(['message' => 'Repeticion not found'], 404);
        }

        $repeticion->delete();
        return response()->json(['message' => 'Repeticion deleted successfully']);
    }
}
