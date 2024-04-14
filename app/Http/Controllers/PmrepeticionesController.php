<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pmrepeticiones;

class PmrepeticionesController extends Controller
{
    public function indexs()
    {
        $pmrepeticiones = Pmrepeticiones::with(['pm', 'repeticion'])->get();
        return view('pmrepeticiones.indexs', compact('pmrepeticiones'));
    }

    public function creates()
    {
        // Assuming you have lists of pm and repeticiones for dropdowns
        return view('pmrepeticiones.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'pm_id' => 'required|exists:pm,id',
            'repeticion_id' => 'required|exists:repeticion,id',
        ]);

        PmRepeticiones::create($validated);

        return redirect()->route('pmrepeticiones.indexs')->with('Exito', 'PmRepeticiones Creado.');
    }

    public function shows(PmRepeticiones $pmrepeticione)
    {
        return view('pmrepeticiones.shows', compact('pmrepeticione'));
    }

    public function edits(PmRepeticiones $pmrepeticione)
    {
        return view('pmrepeticiones.edits', compact('pmrepeticione'));
    }

    public function updates(Request $request, PmRepeticiones $pmrepeticione)
    {
        $validated = $request->validate([
            'pm_id' => 'required|exists:pm,id',
            'repeticion_id' => 'required|exists:repeticion,id',
        ]);

        $pmrepeticione->update($validated);

        return redirect()->route('pmrepeticiones.indexs')->with('Exito', 'PmRepeticiones Actualizado.');
    }

    public function destroys(PmRepeticiones $pmrepeticione)
    {
        $pmrepeticione->delete();

        return redirect()->route('pmrepeticiones.indexs')->with('Exito', 'PmRepeticiones Borrado.');
    }
    //API//
    // GET /pmrepeticiones
    public function index()
    {
        $pmRepeticiones = PmRepeticiones::all();
        return response()->json($pmRepeticiones);
    }

    // POST /pmrepeticiones
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pm_id' => 'required|exists:pm,id',
            'repeticion_id' => 'required|exists:repeticion,id'
        ]);

        $pmRepeticion = PmRepeticiones::create($validated);
        return response()->json($pmRepeticion, 201);
    }

    // GET /pmrepeticiones/{id}
    public function show($id)
    {
        $pmRepeticion = PmRepeticiones::find($id);
        if (!$pmRepeticion) {
            return response()->json(['message' => 'PmRepeticion not found'], 404);
        }
        return response()->json($pmRepeticion);
    }

    // PUT /pmrepeticiones/{id}
    public function update(Request $request, $id)
    {
        $pmRepeticion = PmRepeticiones::find($id);
        if (!$pmRepeticion) {
            return response()->json(['message' => 'PmRepeticion not found'], 404);
        }

        $validated = $request->validate([
            'pm_id' => 'required|exists:pm,id',
            'repeticion_id' => 'required|exists:repeticion,id'
        ]);

        $pmRepeticion->update($validated);
        return response()->json(['message' => 'PmRepeticion updated successfully', 'data' => $pmRepeticion]);
    }

    // DELETE /pmrepeticiones/{id}
    public function destroy($id)
    {
        $pmRepeticion = PmRepeticiones::find($id);
        if (!$pmRepeticion) {
            return response()->json(['message' => 'PmRepeticion not found'], 404);
        }

        $pmRepeticion->delete();
        return response()->json(['message' => 'PmRepeticion deleted successfully']);
    }
}
