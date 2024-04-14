<?php

namespace App\Http\Controllers;

use App\Models\competitors;
use Illuminate\Http\Request;

class CompetitorsController extends Controller
{
    public function indexs()
    {
        $competitors = competitors::with(['users', 'competition'])->get();
        return view('competitors.indexs', compact('competitors'));
    }

    public function creates()
    {
        // You may need to pass users and competitions to your view for selection
        return view('competitors.creates');
    }

    public function stores(Request $request)
    {
        $validated = $request->validate([
            'users_id' => 'required|exists:users,id',
            'competition_id' => 'required|exists:competition,id',
        ]);

        competitors::create($validated);
        return redirect()->route('competitors.indexs')->with('Exito', 'Competidor creado.');
    }

    public function shows(competitors $competitor)
    {
        return view('competitors.shows', compact('competitor'));
    }

    public function edits(Competitors $competitor)
    {
        // Pass the competitor along with users and competitions to your view
        return view('competitors.edits', compact('competitor'));
    }

    public function updates(Request $request, Competitors $competitor)
    {
        $validated = $request->validate([
            'users_id' => 'required|exists:users,id',
            'competition_id' => 'required|exists:competition,id',
        ]);

        $competitor->update($validated);
        return redirect()->route('competitors.indexs')->with('Exito', 'Competidor actualizado.');
    }

    public function destroys(Competitors $competitor)
    {
        $competitor->delete();
        return redirect()->route('competitors.indexs')->with('Exito', 'Competidor Borrado.');
    }
    //API//
    // GET /competitors
    public function index()
    {
        $competitors = Competitors::all();  // Assuming you want to load related user and competition data
        return response()->json($competitors);
    }

    // POST /competitors
    public function store(Request $request)
    {
        $validated = $request->validate([
            'users_id' => 'required|exists:users,id',
            'competition_id' => 'required|exists:competition,id'
        ]);

        $competitor = Competitors::create($validated);
        return response()->json($competitor, 201);
    }

    // GET /competitors/{id}
    public function show($id)
    {
        $competitor = Competitors::find($id);
        if (!$competitor) {
            return response()->json(['message' => 'Competitor not found'], 404);
        }
        return response()->json($competitor);
    }

    // PUT /competitors/{id}
    public function update(Request $request, $id)
    {
        $competitor = Competitors::find($id);
        if (!$competitor) {
            return response()->json(['message' => 'Competitor not found'], 404);
        }

        $validated = $request->validate([
            'users_id' => 'required|exists:users,id',
            'competition_id' => 'required|exists:competition,id'
        ]);

        $competitor->update($validated);
        return response()->json(['message' => 'Competitor updated successfully', 'data' => $competitor]);
    }

    // DELETE /competitors/{id}
    public function destroy($id)
    {
        $competitor = Competitors::find($id);
        if (!$competitor) {
            return response()->json(['message' => 'Competitor not found'], 404);
        }

        $competitor->delete();
        return response()->json(['message' => 'Competitor deleted successfully']);
    }
}
