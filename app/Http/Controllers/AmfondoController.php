<?php

namespace App\Http\Controllers;

use App\Models\Amfondo;
use Illuminate\Http\Request;

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
        $validated = $request->validate([
            'am_id' => 'required|exists:am,id',
            'fondo_id' => 'required|exists:fondo,id'
        ]);

        $amFondo = AmFondo::create($validated);
        return response()->json($amFondo, 201);
    }

    // GET /amfondos/{id}
    public function show($id)
    {
        $amFondo = Amfondo::find($id);
        if (!$amFondo) {
            return response()->json(['message' => 'AmFondo not found'], 404);
        }
        return response()->json($amFondo);
    }

    // PUT /amfondos/{id}
    public function update(Request $request, $id)
    {
        $amFondo = AmFondo::find($id);
        if (!$amFondo) {
            return response()->json(['message' => 'AmFondo not found'], 404);
        }

        $validated = $request->validate([
            'am_id' => 'required|exists:am,id',
            'fondo_id' => 'required|exists:fondo,id'
        ]);

        $amFondo->update($validated);
        return response()->json(['message' => 'AmFondo updated successfully', 'data' => $amFondo]);
    }

    // DELETE /amfondos/{id}
    public function destroy($id)
    {
        $amFondo = AmFondo::find($id);
        if (!$amFondo) {
            return response()->json(['message' => 'AmFondo not found'], 404);
        }

        $amFondo->delete();
        return response()->json(['message' => 'AmFondo deleted successfully']);
    }
}
