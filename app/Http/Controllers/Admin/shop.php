<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products as ModelsShop;
use App\Models\Products;
use Illuminate\Http\Request;

class shop extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        $products = ModelsShop::query();
        if (is_numeric($query)) {
            // Search within the price range
            $products->where('price', '>=', 0)
                ->where('price', '<=', $query);
        } else {
            // Search by name or exact price
            $products->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%")
                    ->orWhere('price', 'LIKE', "%$query%");
            });
            // Order by name starting with the query string
            $products->orderByRaw("CASE WHEN name LIKE '$query%' THEN 1 ELSE 2 END");
        }
        $products = $products->get();
        return view('MainPages.AdminPages.shop.shop', compact('products'));
    }

    public function usershop(Request $request)
    {
        $query = $request->input('query');
        $products = ModelsShop::query();

        if (is_numeric($query)) {
            // Search within the price range
            $products->where('price', '>=', 0)
                ->where('price', '<=', $query);
        } else {
            // Search by name or exact price
            $products->where(function ($q) use ($query) {
                $q->where('name', 'LIKE', "%$query%")
                    ->orWhere('price', 'LIKE', "%$query%");
            });
            // Order by name starting with the query string
            $products->orderByRaw("CASE WHEN name LIKE '$query%' THEN 1 ELSE 2 END");
        }
        $products = $products->get();
        return view('MainPages.shop', compact('products'));
    }

    public function store(request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:25',
            'description' => 'required|string|max:255',
            'quantity' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:999999.99',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjusted for images
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:999999.99',
        ]);
        $image = $request->file('path');
        $imageName = $image->getClientOriginalName();
        $path = $image->storeAs('Equipments', $imageName, 'public');

        $product = new ModelsShop;
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->quantity = $validatedData['quantity'];
        $product->path = $path;
        $product->save();
        return redirect()->back()->with('success', 'Data stored successfully');
    }
    public function delete($id){
        $product = ModelsShop::find($id);
        // Check if the product exists
        if (!$product) {
            return redirect()->back()->with('error', 'product Not Found');
        }

        // Proceed with the deletion
        $product->delete();
        return redirect()->back()->with('success', 'product Deleted successfully');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:25',
            'description' => 'required|string|max:255',
            'path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjusted for images
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:999999.99',
            'quantity' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/|max:999999.99',
            'newprice' => 'nullable|numeric|regex:/^\d+(\.\d{1,2})?$/|max:999999.99',
            'status' => 'required',
        ]);

        $product = ModelsShop::find($id);

        if ($request->hasFile('path')) {
            $image = $request->file('path');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('Equipments', $imageName, 'public');
            $product->path = $path;
        }

        $product->name = $validatedData['name'];
        $product->price = $validatedData['price'];
        $product->quantity = $validatedData['quantity'];
        $product->newprice = $validatedData['newprice'];
        $product->description = $validatedData['description'];
        $product->status = $validatedData['status'];

        $product->save();

        return redirect()->back()->with('success', 'Data Updated successfully');
    }

public function details($id){
$product=Products::find($id);
return view('MainPages.productdetails',compact('product'));
    }

}
