<?php

namespace App\Http\Controllers;

use App\Models\fondo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'Fdistancia' => 'required|integer',
            'Fzona' => 'required|integer|max:2',
        ]);

        Fondo::create($request->all());
        return redirect()->route('fondos.indexs')->with('Exito', 'Fondo Creado.');
    }

    public function shows(Fondo $fondo, $id)
    {
        $item = Fondo::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para ver.');
        }
        return view('fondos.shows', compact('fondo'));
    }

    public function edits(Fondo $fondo, $id)
    {
        $item = Fondo::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para editar.');
        }
        return view('fondos.edits', compact('fondo'));
    }

    public function updates(Request $request, Fondo $fondo)
    {
        $request->validate([
            'Fdistancia' => 'required|integer',
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
        $validator = Validator::make($request->all(),[
            'Fdistancia' => 'required|integer',
            'Fzona' => 'required|integer|max:2',
         ]);

         if ($validator->fails()) {
             return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
         }

         $validated = $validator->validated();
         $am = new fondo([
            'Fdistancia' => $validated['Fdistancia'],
            'Fzona' => $validated['Fzona'],
         ]);

         $am->save();

         return response()->json("Added", 201);
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
     public function update(Request $request, fondo $amre, $id)
    {
       $amre = fondo::find($id);
       if (!$amre) {
           return response()->json(['message' => 'Fondo not found'], 404);
       }

       $validator = Validator::make($request->all(),[
        'Fdistancia' => 'required|integer',
        'Fzona' => 'required|integer|max:2',
       ]);

       if ($validator->fails()) {
           return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
       }

       $validated = $validator->validated(); // Get validated data array

       $amre->update([
        'Fdistancia' => $validated['Fdistancia'],
        'Fzona' => $validated['Fzona'],
       ]);

       return response()->json(['message' => 'Fondo updated successfully', 'data' => $amre]);
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
