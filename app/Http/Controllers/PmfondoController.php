<?php

namespace App\Http\Controllers;

use App\Models\Pmfondo;
use Illuminate\Http\Request;

class PmfondoController extends Controller
{
    public function indexs()
    {
        $pmfondos = Pmfondo::with(['pm', 'fondo'])->get();
        return view('pmfondos.indexs', compact('pmfondos'));
    }

    public function creates()
    {
        return view('pmfondos.creates');
    }

    public function stores(Request $request)
    {
        $request->validate([
            'pm_id' => 'required|exists:pm,id',
            'fondo_id' => 'required|exists:fondo,id',
        ]);

        PmFondo::create($request->all());

        return redirect()->route('pmfondos.indexs')->with('Exito', 'Pmfondo Creado.');
    }

    public function shows(PmFondo $pmfondo)
    {
        return view('pmfondos.shows', compact('pmfondo'));
    }

    public function edits(PmFondo $pmfondo)
    {
        return view('pmfondos.edits', compact('pmfondo'));
    }

    public function updates(Request $request, PmFondo $pmfondo)
    {
        $request->validate([
            'pm_id' => 'required|exists:pm,id',
            'fondo_id' => 'required|exists:fondo,id',
        ]);

        $pmfondo->update($request->all());

        return redirect()->route('pmfondos.indexs')->with('Exito', 'Pmfondo Actualizado.');
    }

    public function destroys(PmFondo $pmfondo)
    {
        $pmfondo->delete();

        return redirect()->route('pmfondos.indexs')->with('Exito', 'Pmfondo Borrado.');
    }
    //API//
    // GET /pmfondos
    public function index()
    {
        $pmFondos = PmFondo::all();
        return response()->json($pmFondos);
    }

    // POST /pmfondos
    public function store(Request $request)
    {
        $validated = $request->validate([
            'pm_id' => 'required|exists:pm,id',
            'fondo_id' => 'required|exists:fondo,id'
        ]);

        $pmFondo = PmFondo::create($validated);
        return response()->json($pmFondo, 201);
    }

    // GET /pmfondos/{id}
    public function show($id)
    {
        $pmFondo = Pmfondo::find($id);
        if (!$pmFondo) {
            return response()->json(['message' => 'PmFondo not found'], 404);
        }
        return response()->json($pmFondo);
    }

    // PUT /pmfondos/{id}
    public function update(Request $request, $id)
    {
        $pmFondo = PmFondo::find($id);
        if (!$pmFondo) {
            return response()->json(['message' => 'PmFondo not found'], 404);
        }

        $validated = $request->validate([
            'pm_id' => 'required|exists:pm,id',
            'fondo_id' => 'required|exists:fondo,id'
        ]);

        $pmFondo->update($validated);
        return response()->json(['message' => 'PmFondo updated successfully', 'data' => $pmFondo]);
    }

    // DELETE /pmfondos/{id}
    public function destroy($id)
    {
        $pmFondo = PmFondo::find($id);
        if (!$pmFondo) {
            return response()->json(['message' => 'PmFondo not found'], 404);
        }

        $pmFondo->delete();
        return response()->json(['message' => 'PmFondo deleted successfully']);
    }
}
