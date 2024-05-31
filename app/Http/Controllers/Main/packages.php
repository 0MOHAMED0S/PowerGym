<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class packages extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $Packages = Package::query();

        if (is_numeric($query)) {
            // Search within the price range
            $Packages->where('price', '>=', 0)
                ->where('price', '<=', $query);
        } else {
            // Search by name or exact price
            $Packages->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%")
                    ->orWhere('price', 'LIKE', "%$query%");
            });
            // Order by name starting with the query string
            $Packages->orderByRaw("CASE WHEN name LIKE '$query%' THEN 1 ELSE 2 END");
        }
        $packages = $Packages->get();
        return view('MainPages.Packages', compact('packages'));
    }
}
