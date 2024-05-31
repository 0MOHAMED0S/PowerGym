<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogoName as ModelsLogoName;
use Illuminate\Http\Request;

class LogoName extends Controller
{
    public function index(Request $request)
    {
        $ModelsLogoName = ModelsLogoName::first();
        return view('MainPages.AdminPages.logo&Name.logoName',compact('ModelsLogoName'));
    }

    public function update(request $request,$id){
        $LogoName = ModelsLogoName::find($id);

        $validatedData = $request->validate([
            'firstname' => 'required|string|max:25',
            'secondname' => 'max:25',
            'path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjusted for images
        ]);
        if ($request->file('path')) {
            $image = $request->file('path');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('Logo', $imageName, 'public');
        } else {
            $path = $LogoName->logopath;
        }
        $LogoName =ModelsLogoName::find($id);
        $LogoName->firstname = $validatedData['firstname'];
        $LogoName->secondname = $validatedData['secondname'];
        $LogoName->logopath = $path;
        $LogoName->save();
        return redirect()->back()->with('success', 'Data Updated successfully');
    }
}
