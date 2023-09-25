<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function home() {
        $products = Product::all();
        return view('home', compact($products));

//        return view('home');

    }
}

