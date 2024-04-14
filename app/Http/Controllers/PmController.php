<?php

namespace App\Http\Controllers;

use App\Models\Pm;
use Illuminate\Http\Request;

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
         $validated = $request->validate([
             'ppm' => 'required|string|in:PM|min:2'
         ]);

         $pm = Pm::create($validated);
         return response()->json($pm, 201);
     }

     // GET /pms/{id}
     public function show($id)
     {
         $pm = Pm::find($id);
         if (!$pm) {
             return response()->json(['message' => 'PM not found'], 404);
         }
         return response()->json($pm);
     }

     // PUT /pms/{id}
     public function update(Request $request, $id)
     {
         $pm = Pm::find($id);
         if (!$pm) {
             return response()->json(['message' => 'PM not found'], 404);
         }

         $validated = $request->validate([
             'ppm' => 'required|string'
         ]);

         $pm->update($validated);
         return response()->json(['message' => 'PM updated successfully', 'data' => $pm]);
     }

     // DELETE /pms/{id}
     public function destroy($id)
     {
         $pm = Pm::find($id);
         if (!$pm) {
             return response()->json(['message' => 'PM not found'], 404);
         }

         $pm->delete();
         return response()->json(['message' => 'PM deleted successfully']);
     }
}
