<?php

namespace App\Http\Controllers;

use App\Models\diteTrain;
use Illuminate\Http\Request;

class dietTrains extends Controller
{
    public function index(request $request)
    {
        return view('MainPages.diteTrain');
    }

    public function store(request $request)
    {
        $validatedData = $request->validate([
            'weight' => 'required|string|max:25',
            'height' => 'required|string|max:25',
            'notes' => 'required|string|max:25',
            'connection' => 'required|string|max:25',
        ]);
        $Equipments = new diteTrain;
        $Equipments->weight = $validatedData['weight'];
        $Equipments->height = $validatedData['height'];
        $Equipments->notes = $validatedData['notes'];
        $Equipments->connection = $validatedData['connection'];
        $Equipments->user_id = auth()->user()->id;
        $Equipments->save();
        return redirect()->back()->with('success', 'Data stored successfully');
    }
    public function dite(request $request)
    {
        $query = $request->input('query');

        $dites = diteTrain::where(function ($q) use ($query) {
            $q->where('connection', 'LIKE', "%$query%");
        })
            ->orderByRaw("CASE WHEN connection LIKE '$query%' THEN 1 ELSE 2 END")
            ->get();
        return view('MainPages.AdminPages.Dite.ditetrain', compact('dites'));
    }
    public function read(Request $request, $id)
    {
        $dite = DiteTrain::find($id);
        $read = $dite->read;
        if ($read == 1) {
            $dite->read = 0;
        } else {
            $dite->read = 1;
        }
        $dite->save();
        return redirect()->back()->with('success', 'updated successfully');
    }
}
