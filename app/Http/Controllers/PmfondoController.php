<?php

namespace App\Http\Controllers;

use App\Models\Pmfondo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(),[
            'pm_id' => 'required|exists:pm,id',
            'fondo_id' => 'required|exists:fondo,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $fondo = new PmFondo([
            'pm_id' => $validated['pm_id'],
            'fondo_id' => $validated['fondo_id'],
        ]);

        $fondo->save();

        return response()->json("Added", 201);
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
    public function update(Request $request, PmFondo $fondo, $id)
    {
        $fondo = PmFondo::find($id);
        if (!$fondo) {
            return response()->json(['message' => 'PmFondo not found'], 404);
        }

        $validator = Validator::make($request->all(),[
            'pm_id' => 'required|exists:pm,id',
            'fondo_id' => 'required|exists:fondo,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $fondo->update([
        'pm_id' => $validated['pm_id'],
        'fondo_id' => $validated['fondo_id'],
        ]);

        return response()->json(['message' => 'PmFondo updated successfully', 'data' => $fondo]);
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
