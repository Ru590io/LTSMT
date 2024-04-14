<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Amrepeticiones;

class AmrepeticionesController extends Controller
{
    public function indexs()
    {
        $amrepeticiones = Amrepeticiones::with(['am', 'repeticion'])->get();
        return view('amrepeticiones.indexs', compact('amrepeticiones'));
    }

    public function creates()
    {
        return view('amrepeticiones.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'am_id' => 'required|exists:am,id',
            'repeticion_id' => 'required|exists:repeticion,id',
        ]);

        AmRepeticiones::create($validated);

        return redirect()->route('amrepeticiones.indexs')->with('Exito', 'AmRepeticiones Creado.');
    }

    public function shows(AmRepeticiones $amrepeticione)
    {
        return view('amrepeticiones.shows', compact('amrepeticione'));
    }

    public function edits(AmRepeticiones $amrepeticione)
    {
        return view('amrepeticiones.edits', compact('amrepeticione'));
    }

    public function updates(Request $request, AmRepeticiones $amrepeticione)
    {
        $validated = $request->validate([
            'am_id' => 'required|exists:am,id',
            'repeticion_id' => 'required|exists:repeticion,id',
        ]);

        $amrepeticione->update($validated);

        return redirect()->route('amrepeticiones.indexs')->with('Exito', 'AmRepeticiones Actualizado.');
    }

    public function destroys(AmRepeticiones $amrepeticione)
    {
        $amrepeticione->delete();

        return redirect()->route('amrepeticiones.indexs')->with('Exito', 'AmRepeticiones Borrado.');
    }
    //API//
     // GET /amrepeticiones
     public function index()
     {
         $amRepeticiones = AmRepeticiones::all();
         return response()->json($amRepeticiones);
     }

     // POST /amrepeticiones
     public function store(Request $request)
     {
         $validated = $request->validate([
             'am_id' => 'required|exists:am,id',
             'repeticion_id' => 'required|exists:repeticion,id'
         ]);

         $amRepeticiones = AmRepeticiones::create($validated);
         return response()->json($amRepeticiones, 201);
     }

     // GET /amrepeticiones/{id}
     public function show($id)
     {
         $amRepeticiones = AmRepeticiones::find($id);
         if (!$amRepeticiones) {
             return response()->json(['message' => 'AmRepeticiones not found'], 404);
         }
         return response()->json($amRepeticiones);
     }

     // PUT /amrepeticiones/{id}
     public function update(Request $request, $id)
     {
         $amRepeticiones = AmRepeticiones::find($id);
         if (!$amRepeticiones) {
             return response()->json(['message' => 'AmRepeticiones not found'], 404);
         }

         $validated = $request->validate([
             'am_id' => 'required|exists:am,id',
             'repeticion_id' => 'required|exists:repeticion,id'
         ]);

         $amRepeticiones->update($validated);
         return response()->json(['message' => 'AmRepeticiones updated successfully', 'data' => $amRepeticiones]);
     }

     // DELETE /amrepeticiones/{id}
     public function destroy($id)
     {
         $amRepeticiones = AmRepeticiones::find($id);
         if (!$amRepeticiones) {
             return response()->json(['message' => 'AmRepeticiones not found'], 404);
         }

         $amRepeticiones->delete();
         return response()->json(['message' => 'AmRepeticiones deleted successfully']);
     }
}
