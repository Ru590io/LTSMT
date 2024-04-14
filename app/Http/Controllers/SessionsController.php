<?php

namespace App\Http\Controllers;

use App\Models\sessions;
use Illuminate\Http\Request;

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
            'am_id' => 'required|exists:ams,id',
            'pm_id' => 'required|exists:pms,id',
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
        $validated = $request->validate([
            'am_id' => 'required|exists:am,id',
            'pm_id' => 'required|exists:pm,id',
            'days_id' => 'required|exists:days,id'
        ]);

        $session = Sessions::create($validated);
        return response()->json($session, 201);
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
    public function update(Request $request, $id)
    {
        $session = Sessions::find($id);
        if (!$session) {
            return response()->json(['message' => 'Session not found'], 404);
        }

        $validated = $request->validate([
            'am_id' => 'required|exists:am,id',
            'pm_id' => 'required|exists:pm,id',
            'days_id' => 'required|exists:days,id'
        ]);

        $session->update($validated);
        return response()->json(['message' => 'Session updated successfully', 'data' => $session]);
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
