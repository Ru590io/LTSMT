<?php

namespace App\Http\Controllers;

use App\Models\descanso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DescansoController extends Controller
{
    public function indexs()
    {
        $descansos = descanso::all();
        return view('descansos.indexs', compact('descansos'));
    }

    public function creates()
    {
        return view('descansos.creates');
    }

    public function stores(Request $request)
    {
        $request->validate([
            'ddescanso' => 'required|string|in:Descanso|max:8',
        ]);

        Descanso::create($request->all());

        return redirect()->route('descansos.indexs')->with('Exito', 'Descanso Agregado.');
    }

    public function shows(Descanso $descanso, $id)
    {
        $item = descanso::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para ver.');
        }
        return view('descansos.shows', compact('descanso'));
    }

    public function edits(Descanso $descanso, $id)
    {
        $item = descanso::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para editar.');
        }
        return view('descansos.edits', compact('descanso'));
    }

    public function updates(Request $request, Descanso $descanso)
    {
        $request->validate([
            'ddescanso' => 'required|string|in:Descanso|max:8',
        ]);

        $descanso->update($request->all());

        return redirect()->route('descansos.indexs')->with('Exito', 'Descanso Actualizado.');
    }

    public function destroys(Descanso $descanso)
    {
        $descanso->delete();

        return redirect()->route('descansos.indexs')->with('Exito', 'Descanso Borrado.');
    }
    //API//
    public function index()
    {
        $descansos = Descanso::all();
        return response()->json($descansos);
    }

    // POST /descansos
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ddescanso' => 'required|string|in:Descanso|max:8',
         ]);

         if ($validator->fails()) {
             return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
         }

         $validated = $validator->validated();
         $am = new descanso([
            'ddescanso' => $validated['ddescanso'],
         ]);

         $am->save();

         return response()->json("Added", 201);
    }

    // GET /descansos/{id}
    public function show($id)
    {
        $descanso = Descanso::find($id);
        if (!$descanso) {
            return response()->json(['message' => 'Descanso no se encontro'], 404);
        }
        return response()->json($descanso);
    }

    // PUT /descansos/{id}
    public function update(Request $request, descanso $amre, $id)
     {
        $amre = descanso::find($id);
        if (!$amre) {
            return response()->json(['message' => 'Descanso no se encontro'], 404);
        }

        $validator = Validator::make($request->all(),[
            'ddescanso' => 'required|string|in:Descanso|max:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $amre->update([
            'ddescanso' => $validated['ddescanso'],
        ]);

        return response()->json(['message' => 'Descanso actualizado', 'data' => $amre]);
     }

    // DELETE /descansos/{id}
    public function destroy($id)
    {
        $descanso = Descanso::find($id);
        if (!$descanso) {
            return response()->json(['message' => 'Descanso no se encontro'], 404);
        }

        $descanso->delete();
        return response()->json(['message' => 'Descanso eliminado']);
    }
}
