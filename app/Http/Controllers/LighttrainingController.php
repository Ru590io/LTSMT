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
        //$lighttraining = lighttraining::with('user')->get(); // Load the user relationship
    return view('Entrenador.Sistema_de_Luces.crear_sistema_de_luces'/*, compact('lighttraining')*/);
    }

    public function create()
    {
        return view('Entrenador.Sistema_de_Luces.sistema_de_luces');
    }

    public function lighttraininglist()
    {
        $lighttrainings = LightTraining::orderBy('id', 'asc')->orderBy('tname', 'asc')->orderBy('ttime', 'asc')->orderBy('tdistance', 'asc')->get(['id','tname', 'ttime', 'tdistance']);

       return view('Entrenador.Sistema_de_Luces.lista_de_sistema_de_luces', compact('lighttrainings'));
    }

    /*private function formatTime($totalSeconds) {
        $minutes = floor($totalSeconds / 60);
        $seconds = $totalSeconds % 60;
        return sprintf('%02d:%02d', $minutes, $seconds);
        foreach ($lighttraining as $training) {
            $training->ttime = $this->formatTime($training->ttime);
        }
    }*/

    public function store(Request $request)
    {
        $message = [
            'tname.regex' => 'El Nombre no puede tener numeros, caracteres especiales y debe tener Mayuscula',
            //'ttime.regex' => 'El tiempo debe estar en formato mm:ss.',
        ];
        //regex:/^\d{1,2}:\d{2}$/
        $validatedData = $request->validate([
            'tname' => 'required|string|max:50|regex:/^[\pL\s]*$/u',
            'ttime' => 'required|max:50000',
            'tdistance' => 'required|integer|max:15000',
        ], $message);

        $timeParts = explode(':', $validatedData['ttime']);
        $totalSeconds = (int)$timeParts[0] * 60 + (int)$timeParts[1];

        $validatedData['users_id'] = auth()->id();
        $validatedData['ttime'] = $totalSeconds;

        LightTraining::create($validatedData);

        return redirect()->route('light.index')->with('Exito', 'Entrenamiento de Luz Creado.');
    }

    public function show(LightTraining $lighttraining)
    {
        return view('Entrenador.Sistema_de_Luces.entrenamiento_de_luces', compact('lighttraining'));
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
        $message = [
            'tname.regex' => 'El Nombre no puede tener numeros, caracteres especiales y debe tener Mayuscula',
        ];
        $validatedData = $request->validate([
            'tname' => 'required|string|max:50|regex:/^[\pL\s]*$/u',
            'ttime' => 'required|integer|max:50000',
            'tdistance' => 'required|integer|max:15000',
            //'users_id' => 'required|exists:users,id',
        ], $message);

        $lighttraining->update($validatedData);

        return redirect()->route('lighttrainings.indexs')->with('Exito', 'Entrenamiento de Luz Actualizado.');
    }

    public function destroy(LightTraining $lighttraining)
    {
        $lighttraining->delete();

        return redirect()->route('light.list')->with('Exito', 'Entrenamiento de Luz Eliminado.');
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
