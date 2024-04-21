<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\lighttraining;
use Illuminate\Support\Facades\Validator;

class LighttrainingController extends Controller
{
    /*Views*/
    public function index()
    {
        $lighttrainings = lighttraining::with('user')->get(); // Load the user relationship
        return view('lighttrainings.indexs', compact('lighttrainings'));
    }

    public function create()
    {
        return view('lighttrainings.creates');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ttime' => 'required|integer',
            'tdistance' => 'required|integer',
            'users_id' => 'required|exists:users,id',
        ]);

        LightTraining::create($request->all());

        return redirect()->route('lighttrainings.indexs')->with('Exito', 'Entrenamiento de Luz Creado.');
    }

    public function show(LightTraining $lighttraining, $id)
    {
        $item = lighttraining::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para ver.');
        }
        return view('lighttrainings.shows', compact('lighttraining'));
    }

    public function edit(LightTraining $lighttraining, $id)
    {
        $item = lighttraining::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para editar.');
        }
        return view('lighttrainings.edits', compact('lighttraining'));
    }

    public function update(Request $request, LightTraining $lighttraining)
    {
        $request->validate([
            'ttime' => 'required|integer',
            'tdistance' => 'required|integer',
            'users_id' => 'required|exists:users,id',
        ]);

        $lighttraining->update($request->all());

        return redirect()->route('lighttrainings.indexs')->with('Exito', 'Entrenamiento de Luz Actualizado.');
    }

    public function destroy(LightTraining $lighttraining)
    {
        $lighttraining->delete();

        return redirect()->route('lighttrainings.indexs')->with('Exito', 'Entrenamiento de Luz Borrado.');
    }

    /*API*////////////////////////////////////////////////////////////////////////////////////////////
    public function seetraining()
    {
        return LightTraining::all();
    }

    public function lighttrainingadded(Request $request){
        $userExists = User::find($request->users_id);

        if (!$userExists) {
            return response()->json(['message' => 'The specified user ID does not exist in our records.'], 404);
        }

        $validator = Validator::make($request->all(),[
            'ttime' => 'required|integer',
            'tdistance' => 'required|integer',
            'users_id' => 'required|exists:users,id',
         ]);

         if ($validator->fails()) {
             return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
         }

         $validated = $validator->validated();
         $am = new lighttraining([
            'ttime' => $validated['ttime'],
            'tdistance' => $validated['tdistance'],
            'users_id' => $validated['users_id'],
         ]);

         $am->save();

         return response()->json("Added", 201);
    }

    // GET /lighttrainings/{id}
    public function specificlighttraining(LightTraining $lightTraining, $id)
    {
        $lightTraining = LightTraining::find($id);
        if (!$lightTraining) {
            return response()->json(['message' => 'Light Training not found'], 404);
        }

        return $lightTraining;
    }

    // PUT /lighttrainings/{id}
    public function updatelighttraining(Request $request, LightTraining $lightTraining, $id)
    {
        $userExists = User::find($request->users_id);

        if (!$userExists) {
            return response()->json(['message' => 'The specified user ID does not exist in our records.'], 404);
        }

        $lightTraining = LightTraining::find($id);
    if (!$lightTraining) {
        return response()->json(['message' => 'Light Training not found'], 404);
    }

        $validator = Validator::make($request->all(),[
        'ttime' => 'required|integer',
        'tdistance' => 'required|integer',
        'users_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array

        $lightTraining->update([
            'ttime' => $validated['ttime'],
            'tdistance' => $validated['tdistance'],
            'users_id' => $validated['users_id'],
           ]);

           return response()->json(['message' => 'Fondo updated successfully', 'data' => $lightTraining]);
    }

    // DELETE /lighttrainings/{id}
    public function erase(LightTraining $lightTraining, $id)
    {
        $lightTraining = LightTraining::find($id);
        if (!$lightTraining) {
        return response()->json(['message' => 'Light Training not found'], 404);
        }

        $lightTraining->delete();

        return response()->json("Deleted succesfully", 200);
    }

}
