<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\weeklyshedule;

class WeeklysheduleController extends Controller
{
    public function indexs()
    {
        $weeklySchedules = weeklyshedule::with('users')->get();
        return view('weeklyschedules.indexs', compact('weeklySchedules'));
    }

    public function create()
    {
        return view('weeklyschedules.creates');
    }

    public function stores(Request $request)
    {
        $request->validate([
            'wstart_date' => 'required|date',
            'wend_date' => 'required|date|after_or_equal:wstart_date',
            'wname' => 'required|string|max:20|alpha',
            'users_id' => 'required|exists:users,id',
        ]);

        WeeklyShedule::create($request->all());

        return redirect()->route('weeklyschedules.indexs')->with('Exito', 'Horario Semanal Creado.');
    }

    public function shows(WeeklyShedule $weeklyschedule)
    {
        return view('weeklyschedules.shows', compact('weeklyschedule'));
    }

    public function edits(WeeklyShedule $weeklyschedule)
    {
        return view('weeklyschedules.edits', compact('weeklyschedule'));
    }

    public function updates(Request $request, WeeklyShedule $weeklyschedule)
    {
        $request->validate([
            'wstart_date' => 'required|date',
            'wend_date' => 'required|date|after_or_equal:wstart_date',
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
        $validated = $request->validate([
            'wstart_date' => 'required|date',
            'wend_date' => 'required|date',
            'wname' => 'required|string',
            'users_id' => 'required|exists:users,id'
        ]);

        $weeklySchedule = WeeklyShedule::create($validated);
        return response()->json($weeklySchedule, 201);
    }

    // GET /weeklyschedules/{id}
    public function show($id)
    {
        $weeklySchedule = WeeklyShedule::find($id);
        if (!$weeklySchedule) {
            return response()->json(['message' => 'Weekly Schedule not found'], 404);
        }
        return response()->json($weeklySchedule);
    }

    // PUT /weeklyschedules/{id}
    public function update(Request $request, $id)
    {
        $weeklySchedule = WeeklyShedule::find($id);
        if (!$weeklySchedule) {
            return response()->json(['message' => 'Weekly Schedule not found'], 404);
        }

        $validated = $request->validate([
            'wstart_date' => 'required|date',
            'wend_date' => 'required|date',
            'wname' => 'required|string',
            'users_id' => 'required|exists:users,id'  // Ensure foreign key integrity
        ]);

        $weeklySchedule->update($validated);
        return response()->json(['message' => 'Weekly Schedule updated successfully', 'data' => $weeklySchedule]);
    }

    // DELETE /weeklyschedules/{id}
    public function destroy($id)
    {
        $weeklySchedule = WeeklyShedule::find($id);
        if (!$weeklySchedule) {
            return response()->json(['message' => 'Weekly Schedule not found'], 404);
        }

        $weeklySchedule->delete();
        return response()->json(['message' => 'Weekly Schedule deleted successfully']);
    }
}
