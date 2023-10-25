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

        $productCount = Product::where('product_owner', $userId)->count();
        $ownProducts = Product::where('product_owner', $userId)->get();

        $product = Product::where('product_owner', '!=', $userId)->inRandomOrder()->take(4)->get();

        return view('home', ['products' => $product, 'product_count' => $productCount, 'own_products' => $ownProducts]);
    }
}
