<?php

namespace App\Http\Controllers;

use App\Models\Pmdescanso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PmdescansoController extends Controller
{
    public function indexs()
    {
        $pmdescansos = Pmdescanso::with(['pm', 'descanso'])->get();
        return view('pmdescansos.indexs', compact('pmdescansos'));
    }

    public function creates()
    {
        // Load PM and Descanso data for selection
        return view('pmdescansos.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'pm_id' => 'required|exists:pm,id',
            'descanso_id' => 'required|exists:descanso,id',
        ]);

        Pmdescanso::create($validated);
        return redirect()->route('pmdescansos.indexs')->with('Exito', 'PmDescanso Creado.');
    }

    public function shows(Pmdescanso $pmdescanso)
    {
        return view('pmdescansos.shows', compact('pmdescanso'));
    }

    public function edits(Pmdescanso $pmdescanso)
    {
        // Load AM and Descanso data for selection
        return view('pmdescansos.edits', compact('pmdescanso'));
    }

    public function updates(Request $request, Pmdescanso $pmdescanso)
    {
        $validated = $request->validate([
            'pm_id' => 'required|exists:pm,id',
            'descanso_id' => 'required|exists:descanso,id',
        ]);

        $pmdescanso->update($validated);
        return redirect()->route('pmdescansos.indexs')->with('Exito', 'PmDescanso Actualizado.');
    }

    public function destroys(Pmdescanso $pmdescanso)
    {
        $pmdescanso->delete();
        return redirect()->route('pmdescansos.indexs')->with('Exito', 'PmDescanso Borrado.');
    }
    //API//
     // GET /pmdescansos
     public function index()
     {
         $pmdescansos = PmDescanso::all();
         return response()->json($pmdescansos);
     }

     // POST /pmdescansos
     public function store(Request $request)
     {
         $validated = $request->validate([
             'pm_id' => 'required|integer|exists:pm,id',
             'descanso_id' => 'required|integer|exists:descanso,id'
         ]);

         $pmdescanso = PmDescanso::create($validated);
         return response()->json($pmdescanso, 201);

     }

     // GET /pmdescansos/{id}
     public function show($id)
     {
        $pmDescanso = PmDescanso::find($id);
        if (!$pmDescanso) {
            return response()->json(['message' => 'PmDescanso not found'], 404);
        }
        return response()->json($pmDescanso);
     }

     // PUT /pmdescansos/{id}
     public function update(Request $request, $id)
     {
         $pmdescanso = PmDescanso::find($id);
         if (!$pmdescanso) {
             return response()->json(['message' => 'PmDescanso not found'], 404);
         }

         $validated = $request->validate([
             'pm_id' => 'required|integer|exists:pm,id',
             'descanso_id' => 'required|integer|exists:descanso,id'
         ]);

         $pmdescanso->update($validated);
         return response()->json(['message' => 'PmDescanso updated successfully', 'data' => $pmdescanso]);
     }

     // DELETE /pmdescansos/{id}
     public function destroy($id)
     {
         $pmdescanso = PmDescanso::find($id);
         if (!$pmdescanso) {
             return response()->json(['message' => 'PmDescanso not found'], 404);
         }

         $pmdescanso->delete();
         return response()->json(['message' => 'PmDescanso deleted successfully']);
     }
}
