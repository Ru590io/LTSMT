<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\lighttraining;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

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
        return view('Entrenador.Sistema_de_Luces.sistema_de_luces');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ttime' => 'required|integer|max:50000',
            'tdistance' => 'required|integer|max:15000',
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
            'ttime' => 'required|integer|max:50000',
            'tdistance' => 'required|integer|max:15000',
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
    public function sendPostRequestToESP($time, $distance){
    $url = 'http://<ESP-IP-ADDRESS>/endpoint'; // Replace with your ESP's actual IP address and endpoint

    $response = Http::post($url, [
        'ttime' => $time,
        'tdistance' => $distance
    ]);

    if ($response->successful()) {
        return 'Success: ' . $response->body();
    } else {
        return 'Error: ' . $response->body();
    }
    }

    public function sendTrainingData(Request $request)
    {
    $validatedData = $request->validate([
        'ttime' => 'required|integer|max:50000',
        'tdistance' => 'required|integer|max:15000',
    ]);

    return $this->sendPostRequestToESP($validatedData['ttime'], $validatedData['tdistance']);
    }

    /*API*////////////////////////////////////////////////////////////////////////////////////////////
    public function seetraining()
    {
        return LightTraining::all();
    }

    public function lighttrainingadded(Request $request){
        $userExists = User::find($request->users_id);

        if (!$userExists) {
            return response()->json(['message' => 'No se encontro ningun usario para este entrenamiento'], 404);
        }

        $validator = Validator::make($request->all(),[
            'ttime' => 'required|integer|max:50000',
            'tdistance' => 'required|integer|max:15000',
            //'users_id' => 'required|exists:users,id',
         ]);


         if ($validator->fails()) {
             return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
         }

         $validated = $validator->validated();
         $timeinseconds = $validated['ttime'] * 60;
         $am = new lighttraining([
            'ttime' => $timeinseconds,
            'tdistance' => $validated['tdistance'],
            'users_id' => auth()->id(),
         ]);

         $am->save();

         return response()->json("Added", 201);
    }

    // GET /lighttrainings/{id}
    public function specificlighttraining(LightTraining $lightTraining, $id)
    {
        $lightTraining = LightTraining::find($id);
        if (!$lightTraining) {
            return response()->json(['message' => 'No se encontro nada'], 404);
        }

        return $lightTraining;
    }

    // PUT /lighttrainings/{id}
    public function updatelighttraining(Request $request, LightTraining $lightTraining, $id)
    {
        $userExists = User::find($request->users_id);

        if (!$userExists) {
            return response()->json(['message' => 'No se encontro ningun usario para este entrenamiento'], 404);
        }

        $lightTraining = LightTraining::find($id);
    if (!$lightTraining) {
        return response()->json(['message' => 'Entrenamiento de Luz no se encontro'], 404);
    }

        $validator = Validator::make($request->all(),[
            'ttime' => 'required|integer|max:50000',
            'tdistance' => 'required|integer|max:15000',
            //'users_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated(); // Get validated data array
        $timeinseconds = $validated['ttime'] * 60;
        $lightTraining->update([
            'ttime' => $timeinseconds,
            'tdistance' => $validated['tdistance'],
            'users_id' => auth()->id(),
           ]);

           return response()->json(['message' => 'Entrenamiento de Luz actualizado', 'data' => $lightTraining]);
    }

    // DELETE /lighttrainings/{id}
    public function erase(LightTraining $lightTraining, $id)
    {
        $lightTraining = LightTraining::find($id);
        if (!$lightTraining) {
        return response()->json(['message' => 'Light Training no se encontro'], 404);
        }

        $lightTraining->delete();

        return response()->json("Entrenamiento de Luz eliminado exitosamente", 200);
    }

}
