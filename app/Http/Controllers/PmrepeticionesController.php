<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pmrepeticiones;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(),[
            'pm_id' => 'required|exists:pm,id',
            'repeticion_id' => 'required|exists:repeticion,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $am = new Pmrepeticiones([
            'pm_id' => $validated['pm_id'],
            'repeticion_id' => $validated['repeticion_id'],
        ]);

        $am->save();

        return response()->json("Added", 201);
    }

    // GET /pmrepeticiones/{id}
    public function show($id)
    {
        $pmRepeticion = PmRepeticiones::find($id);
        if (!$pmRepeticion) {
            return response()->json(['message' => 'PmRepeticion no se encontro'], 404);
        }
        return response()->json($pmRepeticion);
    }

    // PUT /pmrepeticiones/{id}
    public function update(Request $request, Pmrepeticiones $amre, $id)
     {
        $amre = Pmrepeticiones::find($id);
        if (!$amre) {
            return response()->json(['message' => 'AmRepeticiones no se encontro'], 404);
        }

        $validator = Validator::make($request->all(),[
            'pm_id' => 'required|exists:pm,id',
            'repeticion_id' => 'required|exists:repeticion,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $amre->update([
            'pm_id' => $validated['pm_id'],
            'repeticion_id' => $validated['repeticion_id'],
        ]);

        return response()->json(['message' => 'Pmrepeticion actualizado', 'data' => $amre]);
     }

    // DELETE /pmrepeticiones/{id}
    public function destroy($id)
    {
        $pmRepeticion = PmRepeticiones::find($id);
        if (!$pmRepeticion) {
            return response()->json(['message' => 'PmRepeticion no se encuentra'], 404);
        }

        $pmRepeticion->delete();
        return response()->json(['message' => 'PmRepeticion eliminado']);
    }
}
