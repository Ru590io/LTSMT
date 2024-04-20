<?php

namespace App\Http\Controllers;

use App\Models\Am;
use Illuminate\Http\Request;
use App\Http\Resources\V1\AmResource;
use App\Http\Requests\V1\StoreAmrequest;
use Illuminate\Support\Facades\Validator;

class AmController extends Controller
{   /*Views*/
    public function index()
    {
        $am = Am::all();
        return view('am.index', ['am' => $am]);
    }

    public function create()
    {
        return view('am.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'aam' => 'required|string|max:2|in:AM',
        ]);

         Am::create($request->all());

        return redirect()->route('am.index')->with('Exito', 'AM creado con exito.');
    }

    public function show(Am $am)
    {
        return view('am.show', ['am' => $am]);
    }

    public function edit(Am $am)
    {
        return view('am.edit', ['am' => $am]);
    }

    public function update(Request $request, Am $am)
    {
        $request->validate([
            'aam' => 'required|string|min:2|in:AM',
        ]);

        $am->update($request->all());

        return redirect()->route('am.index')->with('Exito', 'AM actualizado con exito.');
    }

    public function destroy(Am $am)
    {
        $am->delete();

        return redirect()->route('am.index')->with('Exito', 'AM Borrado.');
    }

    /*API*//////////////////////////////////////////////////////////////////////////////////////////

    public function see()
    {
        $am = Am::all();

        return $am;
    }

    public function added(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'aam' => 'required|string|min:2|in:AM',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $validated['aam'] = 'AM';
        $am = new Am([
            'aam' => $validated['aam'],
        ]);

        $am->save();

        return response()->json("Added", 201);
    }

     // GET /lighttrainings/{id}
     public function specificam(Am $am, $id)
     {
        $am = Am::find($id);
        if (!$am) {
        return response()->json(['message' => 'Am not found'], 404);
        }

         return $am;
     }

     // PUT /lighttrainings/{id}
     public function amupdate(Request $request, Am $am, $id)
     {
        $am = Am::find($id);
        if (!$am) {
        return response()->json(['message' => 'Am not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'aam' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $am->update([
        'aam' => $validated['aam'],
        ]);

         return response()->json(['message' => 'Am updated successfully', 'data' => $am]);
     }

     
     public function amerase(Am $am, $id)
     {
        $am = Am::find($id);
        if (!$am) {
        return response()->json(['message' => 'Am not found'], 404);
        }
         $am->delete();

         return response()->json("Deleted succesfully", 204);
     }
}
