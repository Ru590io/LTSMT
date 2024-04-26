<?php

namespace App\Http\Controllers;

use App\Models\Pm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PmController extends Controller
{
    public function indexs()
    {
        $pms = Pm::all();
        return view('pm.indexs', compact('pm'));
    }

    public function create()
    {
        return view('pm.creates');
    }

    public function stores(Request $request)
    {
        $validatedData = $request->validate([
            'ppm' => 'required|string|in:PM|min:2',
        ]);

        Pm::create($validatedData);
        return redirect()->route('pms.indexs')->with('Exito', 'PM creado con exito.');
    }

    public function shows(Pm $pm)
    {
        return view('pm.shows', compact('pm'));
    }

    public function edit(Pm $pm)
    {
        return view('pm.edits', compact('pm'));
    }

    public function updates(Request $request, Pm $pm)
    {
        $validatedData = $request->validate([
            'ppm' => 'required|string|in:PM|min:2',
        ]);

        $pm->update($validatedData);
        return redirect()->route('pm.indexs')->with('Exito', 'PM Actualizado con exito.');
    }

    public function destroys(Pm $pm)
    {
        $pm->delete();
        return redirect()->route('pm.indexs')->with('Exito', 'PM Borrado con exito.');
    }
    //API/////////////////////////////////////////////////////////////////////////
     // GET /pms
     public function index()
     {
         return Pm::all();
     }

     // POST /pms
     public function store(Request $request)
     {
        $validator = Validator::make($request->all(), [
            'ppm' => 'required|string|min:2|in:PM',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $validated['aam'] = 'PM';
        $am = new Pm([
            'ppm' => $validated['ppm'],
        ]);

        $am->save();

        return response()->json("Added", 201);
     }

     // GET /pms/{id}
     public function show($id)
     {
         $pm = Pm::find($id);
         if (!$pm) {
             return response()->json(['message' => 'PM no se encontro'], 404);
         }
         return response()->json($pm);
     }

     // PUT /pms/{id}
     public function update(Request $request, Pm $pm, $id)
     {
        $pm = Pm::find($id);
        if (!$pm) {
        return response()->json(['message' => 'Pm no se encontro'], 404);
        }

        $validator = Validator::make($request->all(), [
            'ppm' => 'required|string|in:PM|min:2',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $pm->update([
        'ppm' => $validated['ppm'],
        ]);

         return response()->json(['message' => 'Pm actualizado', 'data' => $pm]);
     }

     // DELETE /pms/{id}
     public function destroy($id)
     {
         $pm = Pm::find($id);
         if (!$pm) {
             return response()->json(['message' => 'PM no se encuentra'], 404);
         }

         $pm->delete();
         return response()->json(['message' => 'PM eliminado exitosamente']);
     }
}
