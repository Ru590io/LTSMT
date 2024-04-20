<?php

namespace App\Http\Controllers;

use App\Models\Amdescanso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AmdescansoController extends Controller
{
    public function indexs()
    {
        $amdescansos = Amdescanso::with(['am', 'descanso'])->get();
        return view('amdescansos.indexs', compact('amdescansos'));
    }

    public function creates()
    {
        // Load AM and Descanso data for selection
        return view('amdescansos.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'am_id' => 'required|exists:am,id',
            'descanso_id' => 'required|exists:descanso,id',
        ]);

        AmDescanso::create($validated);
        return redirect()->route('amdescansos.indexs')->with('Exito', 'AmDescanso Creado.');
    }

    public function shows(AmDescanso $amdescanso)
    {
        return view('amdescansos.shows', compact('amdescanso'));
    }

    public function edits(AmDescanso $amdescanso)
    {
        // Load AM and Descanso data for selection
        return view('amdescansos.edits', compact('amdescanso'));
    }

    public function updates(Request $request, AmDescanso $amdescanso)
    {
        $validated = $request->validate([
            'am_id' => 'required|exists:am,id',
            'descanso_id' => 'required|exists:descanso,id',
        ]);

        $amdescanso->update($validated);
        return redirect()->route('amdescansos.indexs')->with('Exito', 'AmDescanso Actualizado.');
    }

    public function destroys(AmDescanso $amdescanso)
    {
        $amdescanso->delete();
        return redirect()->route('amdescansos.indexs')->with('Exito', 'AmDescanso Borrado.');
    }
    //API//
    // GET /amdescansos
    public function index()
    {
        $amDescansos = AmDescanso::all();
        return response()->json($amDescansos);
    }

    // POST /amdescansos
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'am_id' => 'required|integer|exists:am,id',
            'descanso_id' => 'required|integer|exists:descanso,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $am = new Amdescanso([
            'am_id' => $validated['am_id'],
            'descanso_id' => $validated['descanso_id'],
        ]);

        $am->save();

        return response()->json("Added", 201);
    }

    // GET /amdescansos/{id}
    public function show($id)
    {
        $amDescanso = AmDescanso::find($id);
        if (!$amDescanso) {
            return response()->json(['message' => 'AmDescanso not found'], 404);
        }
        return response()->json($amDescanso);
    }

    // PUT /amdescansos/{id}
    public function update(Request $request, Amdescanso $amdes, $id)
    {
        $amDescanso = AmDescanso::find($id);
        if (!$amDescanso) {
            return response()->json(['message' => 'AmDescanso not found'], 404);
        }

        $validator = Validator::make($request->all(),[
            'am_id' => 'required|integer|exists:am,id',
            'descanso_id' => 'required|integer|exists:descanso,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $amdes->update([
        'am_id' => $validated['am_id'],
        'descanso_id' => $validated['descanso'],
        ]);

        return response()->json(['message' => 'Amdescanso updated successfully', 'data' => $amdes]);
    }

    // DELETE /amdescansos/{id}
    public function destroy($id)
    {
        $amDescanso = AmDescanso::find($id);
        if (!$amDescanso) {
            return response()->json(['message' => 'AmDescanso not found'], 404);
        }

        $amDescanso->delete();
        return response()->json(['message' => 'AmDescanso deleted successfully']);
    }
}
