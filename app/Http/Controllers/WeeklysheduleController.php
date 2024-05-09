<?php

namespace App\Http\Controllers;

use DateTime;
use DateTimeZone;
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
        return view('Entrenador.Registro_de_Entrenamientos.new_registro_de_entrenamientos');
    }

    public function createweek()
    {
        $users = User::where('role', 'Atleta')->get();
        $weeklyschedule = weeklyshedule::with([
            'days.am.descansos',
            'days.am.fondos',
            'days.am.repeticiones',
            'days.pm.descansos',
            'days.pm.fondos',
            'days.pm.repeticiones'
        ])->first();
        return view('Entrenador.Registro_de_Entrenamientos.new_crear_semana_de_entrenamiento', compact('weeklyschedule', 'users'));

    }

    public function listofweekatheletes(){
        //$users = User::with('weeklyshedules')->where('role', 'Atleta')->get();
        //$weeklyShedules = weeklyshedule::with('user')->where('role', 'Atleta')->get();
        $users = User::whereHas('weeklyshedules')->with('weeklyshedules')->where('role', 'Atleta')->paginate(5);
    return view('Entrenador.Registro_de_Entrenamientos.new_atletas_con_semanas_asignadas', compact('users'/*, 'weeklyShedules'*/));
    }

    public function listofweeks($id) {
        $user = User::findOrFail($id);
        // Ensure that you are paginating the weekly schedules related to the specific user
        $weeklySchedules = $user->weeklyshedules()->paginate(5);

        return view('Entrenador.Registro_de_Entrenamientos.new_semanas_del_atleta', compact('user', 'weeklySchedules'));
    }

    public function showUserSchedules($id)
    {

    $user = User::with('weeklyshedules')->findOrFail($id);
    $schedules = $user->weeklySchedules()
                      ->get()
                      ->map(function ($schedule) {
                          return [
                              'wstart_date' => $schedule->wstart_date->formatLocalized('%d de %B %Y'),
                              'wend_date' => $schedule->wend_date->formatLocalized('%d de %B %Y')
                          ];
                      });

    return view('user.schedules', compact('schedules'));
    }

    public function showweekly($id)
{
    $weeklySchedule = WeeklyShedule::with([
        'days.am.descansos',
        'days.am.fondos',
        'days.am.repeticiones',
        'days.pm.descansos',
        'days.pm.fondos',
        'days.pm.repeticiones'
    ])->findOrFail($id);

    $users = User::where('role', 'Atleta')->get();

    return view('Entrenador.Registro_de_Entrenamientos.new_asignar_semana_de_entrenamiento', compact('weeklySchedule', 'users'));
}

    public function createweekschedules(Request $request)
{

        // Create weekly schedule
        $weeklySchedule = new WeeklyShedule();
        $weeklySchedule->wname = $request->wname;
        $weeklySchedule->users_id = auth()->id();  // or any other user identification method
        $weeklySchedule->wstart_date = NULL;
        $weeklySchedule->wend_date = NULL;
        $weeklySchedule->save();

        // Days array for iteration
        $days = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado', 'domingo'];

        foreach ($days as $day) {
            // Create Day model
            $dayModel = new Day();
            $dayModel->day = $day;
            $dayModel->notes = $request->notes; //$request->input($day . '-notes', '');
            $dayModel->weeklyShedule_id = $weeklySchedule->id;
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
        return redirect()->route('week.show', $weeklySchedule->id)
                     ->with('success', 'Schedule created successfully!');
        //return redirect()->route('schedule')->with('success', 'Schedule created successfully!');
}

public function attachActivity($session, $day, $timeOfDay, $type, Request $request) {
    switch ($type) {
        case 'Descanso':
            $descanso = Descanso::Create(['Descanso' => request('Descanso')]);
            $session->descansos()->attach($descanso->id);
            break;
        case 'Fondo':
            $fondoKey = $day . '-' . $timeOfDay . '-Fdistancia';
            $zonaKey = $day . '-' . $timeOfDay . '-Fzona';
            $fondo = Fondo::Create([
                'Fdistancia' => $request->input($fondoKey),
                'Fzona' => $request->input($zonaKey)
            ]);
            $session->fondos()->attach($fondo->id);
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
                $session->repeticiones()->attach($repeticion->id);
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
    $dateRange = explode('/', $request->selectedWeek);
    $startDate = new DateTime($dateRange[0]);
    $endDate = new DateTime($dateRange[1]);
    /*$request->validate([
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
    ]);*/



    $weeklySchedule = WeeklyShedule::findOrFail($id);
    $weeklySchedule->users_id = $request->users_id;
    /*$weeklySchedule->wstart_date = $request->wstart_date;
    $weeklySchedule->wend_date = $request->wend_date;*/
    $weeklySchedule->wstart_date = $startDate->format('Y-m-d');
    $weeklySchedule->wend_date = $endDate->format('Y-m-d');
    $weeklySchedule->save();

    return redirect()->route('week.athletes')->with('Exito', 'Horario Semanal Actualizado.');
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
    public function viewweek($id)
    {
        $weeklySchedule = weeklyshedule::with([
            'days.am.descansos',
            'days.am.fondos',
            'days.am.repeticiones',
            'days.pm.descansos',
            'days.pm.fondos',
            'days.pm.repeticiones',
            'user'
            ])->findOrFail($id);
        $user = User::with('weeklyshedules')->whereHas('weeklyshedules')->where('role', 'Atleta')->get();
    return view('Entrenador.Registro_de_Entrenamientos.new_detalles_de_la_semana_del_atleta', compact('weeklySchedule', 'user'));
    }

    public function editweek($id)
    {
        $weeklyshedule = weeklyshedule::with('user')->get();
        $user = User::with(['weeklyshedules'])->where('id', $id)->first();
        return view('Entrenador.Registro_de_Entrenamientos.new_editar_semana_del_atleta', compact('user'));
    }

    public function updateweek(){

        return redirect()->route('week.view')->with('Exito', 'Horario Semanal Actualizado.');
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
