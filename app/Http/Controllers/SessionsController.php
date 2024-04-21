<?php

namespace App\Http\Controllers;

use App\Models\sessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SessionsController extends Controller
{
    public function indexs()
    {
        $sessions = sessions::with(['am', 'pm', 'day'])->get();
        return view('sessions.indexs', compact('sessions'));
    }

    public function creates()
    {
        // You might need to pass data for `am`, `pm`, and `days` to your view here
        return view('sessions.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'am_id' => 'required|exists:am,id',
            'pm_id' => 'required|exists:pm,id',
            'days_id' => 'required|exists:days,id',
        ]);

        Sessions::create($validated);

        return redirect()->route('sessions.indexs')->with('Exito', 'Seccion Creada.');
    }

    public function shows(Sessions $session)
    {
        return view('sessions.shows', compact('session'));
    }

    public function edits(Sessions $session)
    {
        // Pass necessary data for `am`, `pm`, and `days` to your view here
        return view('sessions.edits', compact('session'));
    }

    public function updates(Request $request, Sessions $session)
    {
        $validated = $request->validate([
            'am_id' => 'required|exists:ams,id',
            'pm_id' => 'required|exists:pms,id',
            'days_id' => 'required|exists:days,id',
        ]);

        $session->update($validated);

        return redirect()->route('sessions.indexs')->with('Exito', 'Seccion Actualizada.');
    }

    public function destroys(Sessions $session)
    {
        $session->delete();

        return redirect()->route('sessions.indexs')->with('Exito', 'Seccion Borrada.');
    }
    //API//
    // GET /sessions
    public function index()
    {
        $sessions = Sessions::all(); // Assuming you have 'day' relation set as 'day'
        return response()->json($sessions);
    }

    // POST /sessions
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'am_id' => 'required|exists:am,id',
            'pm_id' => 'required|exists:pm,id',
            'days_id' => 'required|exists:days,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
        }

        $validated = $validator->validated();
        $am = new sessions([
            'am_id' => $validated['am_id'],
            'pm_id' => $validated['pm_id'],
            'days_id' => $validated['days_id'],
        ]);

        $am->save();

        return response()->json("Added", 201);
    }

    // GET /sessions/{id}
    public function show($id)
    {
        $session = Sessions::find($id);
        if (!$session) {
            return response()->json(['message' => 'session not found'], 404);
        }
        return response()->json($session);
    }

    // PUT /sessions/{id}
    public function update(Request $request, sessions $amre, $id)
    {
       $amre = sessions::find($id);
       if (!$amre) {
           return response()->json(['message' => 'Session not found'], 404);
       }

       $validator = Validator::make($request->all(),[
            'am_id' => 'required|exists:am,id',
            'pm_id' => 'required|exists:pm,id',
            'days_id' => 'required|exists:days,id',
       ]);

       if ($validator->fails()) {
           return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 422);
       }

       $validated = $validator->validated(); // Get validated data array

       $amre->update([
            'am_id' => $validated['am_id'],
            'pm_id' => $validated['pm_id'],
            'days_id' => $validated['days_id'],
       ]);

       return response()->json(['message' => 'Session updated successfully', 'data' => $amre]);
    }

    // DELETE /sessions/{id}
    public function destroy($id)
    {
        $session = Sessions::find($id);
        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        }

        $session->delete();
        return response()->json(['message' => 'Session deleted successfully']);
    }
}
