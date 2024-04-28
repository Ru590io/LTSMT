<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\weeklyshedule;
use Illuminate\Support\Facades\Validator;

class WeeklysheduleController extends Controller
{
    public function indexs()
    {
        $weeklySchedules = weeklyshedule::with('users')->get();
        return view('weeklyschedules.indexs', compact('weeklySchedules'));
    }

    public function create()
    {
        return view('Entrenador.Registro_de_Entrenamientos.registro_de_entrenamientos');
    }

    public function stores(Request $request)
    {
        $request->validate([
            'wstart_date' => 'required|date',
            //'wend_date' => 'required|date|after:wstart_date',
            'wend_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = Carbon::parse($request->wstart_date);
                    $endDate = Carbon::parse($value);
                    if (!$endDate->eq($startDate->addDays(7))) {
                        $fail($attribute . ' debe ser exactamente 7 dias despues del principio de la semana.');
                    }
                },
            ],
            'wname' => 'required|string|max:30|alpha',
            'users_id' => 'required|exists:users,id',
        ]);

        WeeklyShedule::create($request->all());

        return redirect()->route('weeklyschedules.indexs')->with('Exito', 'Horario Semanal Creado.');
    }

    public function shows(WeeklyShedule $weeklyschedule, $id)
    {
        $item = weeklyshedule::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada que ver aqui.');
        }
        return view('weeklyschedules.shows', compact('weeklyschedule'));
    }

    public function edits(WeeklyShedule $weeklyschedule, $id)
    {
        $item = weeklyshedule::find($id);

        if (!$item) {
        return redirect()->route('home')->withErrors('No hay nada aqui para editar.');
        }
        return view('weeklyschedules.edits', compact('weeklyschedule'));
    }

    public function updates(Request $request, WeeklyShedule $weeklyschedule)
    {
        $request->validate([
            'wstart_date' => 'required|date',
            //'wend_date' => 'required|date|after:wstart_date',
            'wend_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = Carbon::parse($request->wstart_date);
                    $endDate = Carbon::parse($value);
                    if (!$endDate->eq($startDate->addDays(7))) {
                        $fail($attribute . ' debe ser exactamente 7 dias despues del principio de la semana.');
                    }
                },
            ],
            'wname' => 'required|string|max:20|alpha',
            'users_id' => 'required|exists:users,id',
        ]);

        $weeklyschedule->update($request->all());

        return redirect()->route('weeklyschedules.indexs')->with('Exito', 'Horario Semanal Actualizado.');
    }

    public function destroys(WeeklyShedule $weeklyschedule)
    {
        $weeklyschedule->delete();

        return redirect()->route('weeklyschedules.indexs')->with('Exito', 'Horario Semanal Borrado.');
    }
    //API//
    // GET /weeklyschedules
    public function index()
    {
        $weeklySchedules = WeeklyShedule::all();  // Assuming you want to load the associated user data
        return response()->json($weeklySchedules);
    }

    // POST /weeklyschedules
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'wstart_date' => 'required|date',
            //'wend_date' => 'required|date|after:wstart_date',
            'wend_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = Carbon::parse($request->wstart_date);
                    $endDate = Carbon::parse($value);
                    if (!$endDate->eq($startDate->addDays(7))) {
                        $fail($attribute . ' debe ser exactamente 7 dias despues del principio de la semana.');
                    }
                },
            ],
            'wname' => 'required|string|max:20|alpha',
            //'users_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $am = new weeklyshedule([
            'wstart_date' => $validated['wstart_date'],
            'wend_date' => $validated['wend_date'],
            'wname' => $validated['wname'],
            'users_id' => auth()->id(),
        ]);

        $am->save();

        return response()->json("Added", 201);
    }

    // GET /weeklyschedules/{id}
    public function show($id)
    {
        $weeklySchedule = WeeklyShedule::find($id);
        if (!$weeklySchedule) {
            return response()->json(['message' => 'Horario semanal no se encontro'], 404);
        }
        return response()->json($weeklySchedule);
    }

    // PUT /weeklyschedules/{id}
    public function update(Request $request, weeklyshedule $amre, $id)
    {
       $amre = weeklyshedule::find($id);
       if (!$amre) {
           return response()->json(['message' => 'Horario semanal no se encontro'], 404);
       }

       $validator = Validator::make($request->all(),[
        'wstart_date' => 'required|date',
        //'wend_date' => 'required|date|after:wstart_date',
        'wend_date' => [
            'required',
            'date',
            function ($attribute, $value, $fail) use ($request) {
                $startDate = Carbon::parse($request->wstart_date);
                $endDate = Carbon::parse($value);
                if (!$endDate->eq($startDate->addDays(7))) {
                    $fail($attribute . ' debe ser exactamente 7 dias despues del principio de la semana.');
                }
            },
        ],
        'wname' => 'required|string|max:20|alpha',
        'users_id' => 'required|exists:users,id',
       ]);

       if ($validator->fails()) {
           return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
       }

       $validated = $validator->validated(); // Get validated data array

       $amre->update([
            'wstart_date' => $validated['wstart_date'],
            'wend_date' => $validated['wend_date'],
            'wname' => $validated['wname'],
            'users_id' => auth()->id(),
       ]);

       return response()->json(['message' => 'Horario actualizado exitosamente', 'data' => $amre]);
    }

    // DELETE /weeklyschedules/{id}
    public function destroy($id)
    {
        $weeklySchedule = WeeklyShedule::find($id);
        if (!$weeklySchedule) {
            return response()->json(['message' => 'Horario Semanal no se encontro'], 404);
        }

        $weeklySchedule->delete();
        return response()->json(['message' => 'Horario se Elimino exitosamente']);
    }
}
