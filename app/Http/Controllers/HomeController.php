<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

// Import the Post model

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $userId = Auth::id();

        $search = '';


        $productCount = Product::where('product_owner', $userId)->count();
        $ownProducts = Product::where('product_owner', $userId)->get();


        return view('home', ['product_count' => $productCount, 'own_products' => $ownProducts]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'private' => 'string',
        ]);

        $private = $request->private;

        if ($private === 'on') {
            $private = 1;
        } else {
            $private = 0;
        }

        // Find the product by ID
        $productToUpdate = Product::find($request->id);

        $this->authorize('view', $productToUpdate);


        // Update the private state based on the request
        $productToUpdate->private = $private;

        // Save the changes
        $productToUpdate->save();

        $userId = Auth::id();


        $productCount = Product::where('product_owner', $userId)->count();
        $ownProducts = Product::where('product_owner', $userId)->get();


        // Redirect back to the list view
        return view('home', ['product_count' => $productCount, 'own_products' => $ownProducts])->with('success', 'Product updated successfully.');
    }


}
