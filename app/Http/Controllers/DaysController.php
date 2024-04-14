<?php

namespace App\Http\Controllers;

use App\Models\day;
use Illuminate\Http\Request;

class DaysController extends Controller
{
    public function indexs()
    {
        $days = day::with('weeklyschedule')->get(); // Adjust based on your relationships
        return view('days.indexs', compact('days'));
    }

    public function creates()
    {
        return view('days.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'day' => 'required|string|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
            'notes' => 'required|string|max:140',
            'weeklyschedule_id' => 'required|exists:weeklyschedule,id',
        ]);

        Day::create($validated);

        return redirect()->route('days.indexs')->with('Exito', 'Dia Agredado.');
    }

    public function shows(Day $day)
    {
        return view('days.shows', compact('day'));
    }

    public function edits(Day $day)
    {
        return view('days.edits', compact('day'));
    }

    public function updates(Request $request, Day $day)
    {
        $validated = $request->validate([
            'day' => 'required|string|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
            'notes' => 'required|string|max:140',
            'weeklyschedule_id' => 'required|exists:weeklyschedule,id',
        ]);

        $day->update($validated);

        return redirect()->route('days.indexs')->with('Exito', 'Dia Actualizado.');
    }

    public function destroys(Day $day)
    {
        $day->delete();

        return redirect()->route('days.indexs')->with('Exito', 'Dia Borrado.');
    }
    //API//
    // GET /days
    public function index()
    {
        $days = Day::all(); // Assuming you want to load the associated weekly schedules
        return response()->json($days);
    }

    // POST /days
    public function store(Request $request)
    {
        $validated = $request->validate([
            'day' => 'required|string',
            'notes' => 'required|string',
            'weeklyshedule_id' => 'required|exists:weeklyshedule,id'  // Ensure it matches your table name
        ]);

        $day = Day::create($validated);
        return response()->json($day, 201);
    }

    // GET /days/{id}
    public function show($id)
    {
        $day = Day::find($id);
        if (!$day) {
            return response()->json(['message' => 'Day not found'], 404);
        }
        return response()->json($day);
    }

    // PUT /days/{id}
    public function update(Request $request, $id)
    {
        $day = Day::find($id);
        if (!$day) {
            return response()->json(['message' => 'Day not found'], 404);
        }

        $validated = $request->validate([
            'day' => 'required|string',
            'notes' => 'required|string',
            'weeklyshedule_id' => 'required|exists:weeklyshedule,id'
        ]);

        $day->update($validated);
        return response()->json(['message' => 'Day updated successfully', 'data' => $day]);
    }

    // DELETE /days/{id}
    public function destroy($id)
    {
        $day = Day::find($id);
        if (!$day) {
            return response()->json(['message' => 'Day not found'], 404);
        }

        $day->delete();
        return response()->json(['message' => 'Day deleted successfully']);
    }
}
