<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Equipment as Equipments;

class Equipment extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

    $equipments = Equipments::where(function ($q) use ($query) {
        $q->where('name', 'LIKE', "%$query%");    })
    ->orderByRaw("CASE WHEN name LIKE '$query%' THEN 1 ELSE 2 END")
    ->get();
        return view('MainPages.AdminPages.equipments.equipments',compact('equipments'));
    }

    public function store(request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:25',
            'quantity' => 'required',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjusted for images
        ]);
            $image = $request->file('path');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('Equipments', $imageName, 'public');

        $Equipments = new Equipments;
        $Equipments->name = $validatedData['name'];
        $Equipments->path = $path;
        $Equipments->quantity = $validatedData['quantity'];
        $Equipments->save();
        return redirect()->back()->with('success', 'Data stored successfully');
    }

    public function delete($id){
        $Equipments = Equipments::find($id);
        // Check if the product exists
        if (!$Equipments) {
            return redirect()->route('AdminPackages')->with('error', 'Equipment Not Found');
        }

        // Proceed with the deletion
        $Equipments->delete();
        return redirect()->back()->with('success', 'Data Deleted successfully');
    }

    public function update(request $request,$id){
        $Equipments = Equipments::find($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:25',
            'quantity' => 'required',
            'path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjusted for images
        ]);
        if ($request->file('path')) {
            $image = $request->file('path');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('Equipments', $imageName, 'public');
        } else {
            $path = $Equipments->path;
        }
        $Equipments =Equipments::find($id);
        $Equipments->name = $validatedData['name'];
        $Equipments->quantity = $validatedData['quantity'];
        $Equipments->path = $path;
        $Equipments->save();
        return redirect()->back()->with('success', 'Data Updated successfully');
    }
}
