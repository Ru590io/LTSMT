<?php

namespace App\Http\Controllers;

use App\Models\repeticiones;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RepeticionController extends Controller
{
    public function indexs()
    {
        $repeticiones = repeticiones::all();
        return view('repeticions.indexs', compact('repeticions'));
    }

    public function creates()
    {
        return view('repeticions.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'Rdistancia' => 'required|integer|max:15000',
            'Rsets' => 'required|integer|max:50',
            'Rtiempoesperado' => 'required|integer|max:50000',
            'Rrecuperacion' => 'required|integer|max:1000',
        ]);

        Repeticiones::create($validated);
        return redirect()->route('repeticions.indexs')->with('Exito', 'Repeticion Creada');
    }

    public function shows(Repeticiones $repeticion, $id)
    {
        $item = repeticiones::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para ver.');
        }
        return view('repeticions.shows', compact('repeticion'));
    }

    public function edits(Repeticiones $repeticion, $id)
    {
        $item = repeticiones::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para editar.');
        }
        return view('repeticions.edits', compact('repeticion'));
    }

    public function updates(Request $request, Repeticiones $repeticion)
    {
        $validated = $request->validate([
            'Rdistancia' => 'required|integer|max:15000',
            'Rsets' => 'required|integer|max:50',
            'Rtiempoesperado' => 'required|integer|max:50000',
            'Rrecuperacion' => 'required|integer|max:1000',
        ]);

        $repeticion->update($validated);
        return redirect()->route('repeticions.indexs')->with('Exito', 'Repeticion Actualizada');
    }

    public function destroys(Repeticiones $repeticion)
    {
        $repeticion->delete();
        return redirect()->route('repeticions.indexs')->with('Exito', 'Repeticion Borrada');
    }
    //API//
    // GET /repeticions
    public function index()
    {
        $repeticiones = Repeticiones::all();
        return response()->json($repeticiones);
    }

    // POST /repeticions
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'Rdistancia' => 'required|integer|max:15000',
            'Rsets' => 'required|integer|max:50',
            'Rtiempoesperado' => 'required|integer|max:50000',
            'Rrecuperacion' => 'required|integer|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $am = new repeticiones([
            'Rdistancia' => $validated['Rdistancia'],
            'Rsets' => $validated['Rsets'],
            'Rtiempoesperado' => $validated['Rtiempoesperado'],
            'Rrecuperacion' => $validated['Rrecuperacion'],
        ]);

        $am->save();

        return response()->json("Agregado", 201);
    }

    // GET /repeticions/{id}
    public function show($id)
    {
        $repeticion = Repeticiones::find($id);
        if (!$repeticion) {
            return response()->json(['message' => 'Repeticion no se encontro'], 404);
        }
        return response()->json($repeticion);
    }

    // PUT /repeticions/{id}
    public function update(Request $request, repeticiones $amre, $id)
    {
       $amre = repeticiones::find($id);
       if (!$amre) {
           return response()->json(['message' => 'Repeticiones no se encontro'], 404);
       }

       $validator = Validator::make($request->all(),[
        'Rdistancia' => 'required|integer|max:15000',
        'Rsets' => 'required|integer|max:50',
        'Rtiempoesperado' => 'required|integer|max:50000',
        'Rrecuperacion' => 'required|integer|max:1000',
       ]);

       if ($validator->fails()) {
           return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
       }

       $validated = $validator->validated(); // Get validated data array

       $amre->update([
        'Rdistancia' => $validated['Rdistancia'],
        'Rsets' => $validated['Rsets'],
        'Rtiempoesperado' => $validated['Rtiempoesperado'],
        'Rrecuperacion' => $validated['Rrecuperacion'],
       ]);

       return response()->json(['message' => 'Repeticion actualizada', 'data' => $amre]);
    }

    // DELETE /repeticions/{id}
    public function destroy($id)
    {
        $repeticion = Repeticiones::find($id);
        if (!$repeticion) {
            return response()->json(['message' => 'Repeticion no se encontro'], 404);
        }

        $repeticion->delete();
        return response()->json(['message' => 'Repeticion se elimino']);
    }
}
