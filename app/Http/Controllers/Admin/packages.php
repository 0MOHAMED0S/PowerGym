<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\features;
use App\Models\Package;
use Illuminate\Http\Request;

class packages extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('query');

    $packages = Package::where(function ($q) use ($query) {
        $q->where('name', 'LIKE', "%$query%");
    })
    ->orderByRaw("CASE WHEN name LIKE '$query%' THEN 1 ELSE 2 END")
    ->get();

    return view('MainPages.AdminPages.packages.packages', compact('packages'));
}

    public function store(request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:25',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:999999.99',
        ]);

        $Package = new Package;
        $Package->name = $validatedData['name'];
        $Package->price = $validatedData['price'];
        $Package->save();
        return redirect()->route('AdminPackages')->with('success', 'Data stored successfully');
    }

    public function update(request $request,$id){
        $validatedData = $request->validate([
            'name' => 'required|string|max:25',
            'status'=>'required',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:999999.99',
        ]);

        $Package = Package::find($id);
        $Package->name = $validatedData['name'];
        $Package->status = $validatedData['status'];
        $Package->price = $validatedData['price'];
        $Package->save();
        return redirect()->route('AdminPackages')->with('success', 'Data Updated successfully');
    }
    public function delete($id){
        $package = package::find($id);
        // Check if the product exists
        if (!$package) {
            return redirect()->route('AdminPackages')->with('error', 'Package Not Found');
        }

        // Proceed with the deletion
        $package->delete();
        return redirect()->route('AdminPackages')->with('success', 'Data Deleted successfully');
    }
    public function AddFeatures(request $request,$id){
        $validatedData = $request->validate([
            'features' => 'required|string|max:50',
        ]);

        $features = new features;
        $features->feature = $validatedData['features'];
        $features->package_id = $id;
        $features->save();
        return redirect()->route('AdminPackages')->with('success', 'Data Stored successfully');
    }

    public function DeleteFeature($id){
        $features = features::find($id);
        // Check if the product exists
        if (!$features) {
            return redirect()->route('AdminPackages')->with('error', 'feature Not Found');
        }

        // Proceed with the deletion
        $features->delete();
        return redirect()->route('AdminPackages')->with('success', 'Data Deleted successfully');
    }
}
