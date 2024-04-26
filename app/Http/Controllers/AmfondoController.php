<?php

namespace App\Http\Controllers;

use App\Models\Amfondo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AmfondoController extends Controller
{
    public function indexs()
    {
        $amfondos = Amfondo::with(['am', 'fondo'])->get();
        return view('amfondos.indexs', compact('amfondos'));
    }

    public function creates()
    {
        return view('amfondos.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'am_id' => 'required|exists:am,id',
            'fondo_id' => 'required|exists:fondo,id',
        ]);

        AmFondo::create($validated);
        return redirect()->route('amfondos.indexs')->with('Exito', 'Amfondo Creado.');
    }

    public function shows(AmFondo $amfondo)
    {
        return view('amfondos.shows', compact('amfondo'));
    }

    public function edits(AmFondo $amfondo)
    {
        return view('amfondos.edits', compact('amfondo'));
    }

    public function updates(Request $request, AmFondo $amfondo)
    {
        $validated = $request->validate([
            'am_id' => 'required|exists:am,id',
            'fondo_id' => 'required|exists:fondo,id',
        ]);

        $amfondo->update($validated);
        return redirect()->route('amfondos.indexs')->with('Exito', 'Amfondo Actualizado.');
    }

    public function destroys(AmFondo $amfondo)
    {
        $amfondo->delete();
        return redirect()->route('amfondos.indexs')->with('Exito', 'Amfondo Borrado.');
    }
    //API//
    // GET /amfondos
    public function index()
    {
        $amFondos = AmFondo::all();
        return response()->json($amFondos);
    }

    // POST /amfondos
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'am_id' => 'required|exists:am,id',
            'fondo_id' => 'required|exists:fondo,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $fondo = new AmFondo([
            'am_id' => $validated['am_id'],
            'fondo_id' => $validated['fondo_id'],
        ]);

        $fondo->save();

        return response()->json("Added", 201);
    }



    // GET /amfondos/{id}
    public function show($id)
    {
        $amFondo = Amfondo::find($id);
        if (!$amFondo) {
            return response()->json(['message' => 'AmFondo no se encontro'], 404);
        }
        return response()->json($amFondo);
    }

    // PUT /amfondos/{id}
    public function update(Request $request, AmFondo $fondo, $id)
    {
        $fondo = AmFondo::find($id);
        if (!$fondo) {
            return response()->json(['message' => 'AmFondo no se encontro'], 404);
        }

        $validator = Validator::make($request->all(),[
            'am_id' => 'required|exists:am,id',
            'fondo_id' => 'required|exists:fondo,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $fondo->update([
        'am_id' => $validated['am_id'],
        'fondo_id' => $validated['fondo_id'],
        ]);

        return response()->json(['message' => 'AmFondo actualizado', 'data' => $fondo]);
    }

    // DELETE /amfondos/{id}
    public function destroy($id)
    {
        $amFondo = AmFondo::find($id);
        if (!$amFondo) {
            return response()->json(['message' => 'AmFondo no se encontro'], 404);
        }

        $amFondo->delete();
        return response()->json(['message' => 'AmFondo eliminado']);
    }
}
