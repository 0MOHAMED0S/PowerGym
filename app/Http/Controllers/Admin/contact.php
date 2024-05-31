<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\contact as contacts;

class contact extends Controller
{
    public function index(){
        $contacts=contacts::first();
        return view('MainPages.AdminPages.contact.contact',compact('contacts'));
    }

    public function update(request $request,$id){
        $contact = contacts::find($id);

        $validatedData = $request->validate([
            'location' => 'required|string',
            'phone' => 'required|max:255',
            'whatsapp' => 'max:255',
            'facebooklink' => 'max:255',
            'instgramlink' => 'max:255',
            'xlink' => 'max:255',
            'daysopen' => 'max:255',
            'timeopen' => 'max:255',
        ]);
        $contact =contacts::find($id);
        $contact->location = $validatedData['location'];
        $contact->phone = $validatedData['phone'];
        $contact->whatsapp = $validatedData['whatsapp'];
        $contact->facebooklink = $validatedData['facebooklink'];
        $contact->instgramlink = $validatedData['instgramlink'];
        $contact->timeopen = $validatedData['timeopen'];
        $contact->daysopen = $validatedData['daysopen'];
        $contact->xlink = $validatedData['xlink'];
        $contact->save();
        return redirect()->back()->with('success', 'Data Updated successfully');
    }
}
