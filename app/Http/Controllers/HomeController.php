<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
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

        $productCount = Product::where('product_owner', $userId)->count();
        $listCount = Catalog::where('user_id', $userId)->count();
        $ownProducts = Product::where('product_owner', $userId)->get();

        $ownLists = Catalog::where('user_id', $userId)->get();

        return view('home', ['product_count' => $productCount, 'list_count' => $listCount, 'own_products' => $ownProducts, 'own_lists' => $ownLists]);
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

        $listCount = Catalog::where('user_id', $userId)->count();
        $productCount = Product::where('product_owner', $userId)->count();
        $ownProducts = Product::where('product_owner', $userId)->get();

        $ownLists = Catalog::where('user_id', $userId)->get();

        return view('home', ['product_count' => $productCount, 'list_count' => $listCount, 'own_products' => $ownProducts, 'own_lists' => $ownLists]);
    }


}
