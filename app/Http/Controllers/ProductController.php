<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::find($id); // Assuming you're using Eloquent
        return view('products.show', compact('product'));
    }

    public function overview()
    {
        $products = Product::all();
        return view('products.list', compact('products'));
    }

}
