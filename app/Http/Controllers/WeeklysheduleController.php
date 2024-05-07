<?php

namespace App\Http\Controllers;

use App\Models\Am;
use App\Models\Pm;
use Carbon\Carbon;
use App\Models\day;
use App\Models\User;
use App\Models\fondo;
use App\Models\descanso;
use App\Models\repeticiones;
use Illuminate\Http\Request;
use App\Models\weeklyshedule;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WeeklysheduleController extends Controller
{
    public function indexs()
    {
        $weeklySchedules = weeklyshedule::with('users')->get();
        return view('weeklyschedules.indexs', compact('weeklySchedules'));
    }

    public function optionsweek()
    {
        return view('Entrenador.Registro_de_Entrenamientos.registro_de_entrenamientos');
    }

    public function createweek()
    {
        $weeklyschedule = weeklyshedule::with([
        'days.am.descanso',
        'days.am.fondo',
        'days.am.repeticion',
        'days.pm.descanso',
        'days.pm.fondo',
        'days.pm.repeticion'
        ])->first();
        return view('Entrenador.Registro_de_Entrenamientos.crear_semana_de_entrenamiento', compact('weeklyschedule'));

    }

    public function listofweekatheletes(){
        $users = User::with('weeklyshedule')->get();
        $weeklyschedule = weeklyshedule::with('users')->get();
    }

    public function listofweeks($u){
        $users = User::with('weeklyshedule')->findOrFail($u);
        $weeklyschedule = weeklyshedule::with('users')->get();
    }
    public function showUserSchedules($id)
    {

    $user = User::with('weeklyshedule')->findOrFail($id);
    /*Carbon::parse($weeklySchedule->wstart_date)->formatLocalized('%d de %B %Y')
    Carbon::parse($weeklySchedule->wend_date)->formatLocalized('%d de %B %Y')*/
    $schedules = $user->weeklySchedules()
                      ->get()
                      ->map(function ($schedule) {
                          return [
                              'start_date' => $schedule->wstart_date->formatLocalized('%d de %B %Y'),
                              'end_date' => $schedule->wend_date->formatLocalized('%d de %B %Y')
                          ];
                      });

    return view('user.schedules', compact('schedules'));
    }

    public function showweekly($id)
{
    $weeklySchedule = WeeklyShedule::with([
        'days.am.descanso',
        'days.am.fondo',
        'days.am.repeticion',
        'days.pm.descanso',
        'days.pm.fondo',
        'days.pm.repeticion'
    ])->findOrFail($id);

    $users = User::get();

    return view('weekly_schedules.show', compact('weeklySchedule', 'users'));
}

    public function createweekschedules(Request $request)
{
        // Create weekly schedule
        $weeklyschedule = new WeeklyShedule();
        $weeklyschedule->wname = $request->wname;
        $weeklyschedule->users_id = auth()->id();  // or any other user identification method
        $weeklyschedule->wstart_date = NULL;
        $weeklyschedule->wend_date = NULL;
        $weeklyschedule->save();

        // Days array for iteration
        $days = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];

        foreach ($days as $day) {
            // Create Day model
            $dayModel = new Day();
            $dayModel->day = $day;
            $dayModel->notes = $request->notes; //$request->input($day . '-notes', '');
            $dayModel->weeklyshedule_id = $weeklyschedule->id;
            $dayModel->save();

            // Process AM session
        $amSession = new Am();
        $amSession->save();

        // Create and attach PM session
        $pmSession = new Pm();
        $pmSession->save();

        // Attach both AM and PM session IDs to the day
        $dayModel->am()->attach($amSession->id, ['pm_id' => $pmSession->id]);

        // Attach activity types to sessions
        $this->attachActivity($amSession, $day, 'am', $request->input($day . '-am'), $request);
        $this->attachActivity($pmSession, $day, 'pm', $request->input($day . '-pm'), $request);

        }
        /*return redirect()->route('weeklyschedule.edit', $weeklyschedule->id)
                     ->with('success', 'Schedule created successfully!');*/
        return redirect()->route('schedule')->with('success', 'Schedule created successfully!');
}

public function attachActivity($session, $day, $timeOfDay, $type, Request $request) {
    switch ($type) {
        case 'Descanso':
            $descanso = Descanso::Create(['Descanso' => request('Descanso')]);
            $session->descanso()->attach($descanso->id);
            break;
        case 'Fondo':
            $fondoKey = $day . '-' . $timeOfDay . '-Fdistancia';
            $zonaKey = $day . '-' . $timeOfDay . '-Fzona';
            $fondo = Fondo::Create([
                'Fdistancia' => $request->input($fondoKey),
                'Fzona' => $request->input($zonaKey)
            ]);
            $session->fondo()->attach($fondo->id);
            break;
        case 'Repeticion':
            $sets = $request->input($day . '-' . $timeOfDay . '-Rsets', []);
            $distancias = $request->input($day . '-' . $timeOfDay . '-Rdistancia', []);
            $tiemposEsperados = $request->input($day . '-' . $timeOfDay . '-Rtiempoesperado', []);
            $recuperaciones = $request->input($day . '-' . $timeOfDay . '-Rrecuperacion', []);

            foreach ($sets as $index => $set) {
                $distancia = $distancias[$index] ?? null;
                $tiempoesperado = $this->convertTimeToSeconds($tiemposEsperados[$index] ?? '0:0');
                $recuperacion = $this->convertTimeToSeconds($recuperaciones[$index] ?? '0:0');

                $repeticion = Repeticiones::Create([
                    'Rdistancia' => $distancia,
                    'Rsets' => $set,
                    'Rtiempoesperado' => $tiempoesperado,
                    'Rrecuperacion' => $recuperacion
                ]);
                $session->repeticion()->attach($repeticion->id);
            }
            break;
    }
}

function convertTimeToSeconds($timeString) {
    $timeParts = explode(':', $timeString);
    if (count($timeParts) == 2) {
        return (int)$timeParts[0] * 60 + (int)$timeParts[1];
    }
    return 0;
}

public function updateweekly(Request $request, $id)
{
    $request->validate([
        'wstart_date' => 'required|date',
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
        'users_id' => 'required|exists:users,id',
    ]);

    $weeklySchedule = WeeklyShedule::findOrFail($id);
    $weeklySchedule->users_id = $request->users_id;
    $weeklySchedule->wstart_date = $request->wstart_date;
    $weeklySchedule->wend_date = $request->wend_date;
    $weeklySchedule->save();

    return redirect()->route('weeklyschedules.indexs')->with('Exito', 'Horario Semanal Actualizado.');
}

public function atletaupdate(Request $request, WeeklyShedule $weeklyschedule)
{
    // First update the weekly schedule itself if needed
    $weeklyschedule->update([
        'wname' => $request->input('wname'), // Example for updating name
        // other fields to update
    ]);

    // Update Fondo
    if ($request->has('fondo')) {
        foreach ($request->input('fondo') as $fondoId => $fondoData) {
            Fondo::where('id', $fondoId)->update([
                'Fdistancia' => $fondoData['Fdistancia'],
                'Fzona' => $fondoData['Fzona'],
            ]);
        }
    }

    // Update Descanso
    if ($request->has('descanso')) {
        foreach ($request->input('descanso') as $descansoId => $descansoData) {
            Descanso::where('id', $descansoId)->update([
                'ddescanso' => $descansoData['ddescanso'], // Assume ddescanso is a field you want to update
            ]);
        }
    }

    // Update Repeticiones
    if ($request->has('repeticiones')) {
        foreach ($request->input('repeticiones') as $repeticionId => $repeticionData) {
            Repeticiones::where('id', $repeticionId)->update([
                'Rdistancia' => $repeticionData['Rdistancia'],
                'Rsets' => $repeticionData['Rsets'],
                'Rtiempoesperado' => $repeticionData['Rtiempoesperado'],
                'Rrecuperacion' => $repeticionData['Rrecuperacion'],
            ]);
        }
    }

    return redirect()->route('some.route')->with('success', 'Weekly schedule updated successfully!');
}
    public function listweek()
    {
        return view('Entrenador.Registro_de_Entrenamientos.lista_de_entrenamientos');
    }

    public function seeweek()
    {
        return view('Entrenador.Registro_de_Entrenamientos.calendario_de_atletas');
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
