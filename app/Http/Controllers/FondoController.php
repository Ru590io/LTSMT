<?php

namespace App\Http\Controllers;

use App\Models\fondo;
use Illuminate\Http\Request;

class FondoController extends Controller
{
    public function indexs()
    {
        $fondos = fondo::all();
        return view('fondos.indexs', compact('fondos'));
    }

    public function creates()
    {
        return view('fondos.creates');
    }

    public function stores(Request $request)
    {
        $request->validate([
            'Fdistancia' => 'required|string|max:100|alpha_num',
            'Fzona' => 'required|integer|max:2',
        ]);

        Fondo::create($request->all());
        return redirect()->route('fondos.indexs')->with('Exito', 'Fondo Creado.');
    }

    public function shows(Fondo $fondo)
    {
        return view('fondos.shows', compact('fondo'));
    }

    public function edits(Fondo $fondo)
    {
        return view('fondos.edits', compact('fondo'));
    }

    public function updates(Request $request, Fondo $fondo)
    {
        $request->validate([
            'Fdistancia' => 'required|string|max:100|alpha_num',
            'Fzona' => 'required|integer|max:2',
        ]);

        $fondo->update($request->all());
        return redirect()->route('fondos.indexs')->with('Exito', 'Fondo Actualizado.');
    }

    public function destroys(Fondo $fondo)
    {
        $fondo->delete();
        return redirect()->route('fondos.indexs')->with('Exito', 'Fondo Borrado.');
    }
    //API//
     // GET /fondos
     public function index()
     {
         $fondos = Fondo::all();
         return response()->json($fondos);
     }

     // POST /fondos
     public function store(Request $request)
     {
         $validated = $request->validate([
             'Fdistancia' => 'required|string',
             'Fzona' => 'required|integer'
         ]);

         $fondo = Fondo::create($validated);
         return response()->json($fondo, 201);
     }

     // GET /fondos/{id}
     public function show($id)
     {
         $fondo = Fondo::find($id);
         if (!$fondo) {
             return response()->json(['message' => 'Fondo not found'], 404);
         }
         return response()->json($fondo);
     }

     // PUT /fondos/{id}
     public function update(Request $request, $id)
     {
         $fondo = Fondo::find($id);
         if (!$fondo) {
             return response()->json(['message' => 'Fondo not found'], 404);
         }

         $validated = $request->validate([
             'Fdistancia' => 'required|string',
             'Fzona' => 'required|integer'
         ]);

         $fondo->update($validated);
         return response()->json(['message' => 'Fondo updated successfully', 'data' => $fondo]);
     }

     // DELETE /fondos/{id}
     public function destroy($id)
     {
         $fondo = Fondo::find($id);
         if (!$fondo) {
             return response()->json(['message' => 'Fondo not found'], 404);
         }

         $fondo->delete();
         return response()->json(['message' => 'Fondo deleted successfully']);
     }
}
