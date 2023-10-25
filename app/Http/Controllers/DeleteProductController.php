<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeleteProductController extends Controller
{
    public function delete($id)
    {
        $product = Product::find($id);

        if ($product['product_owner'] == Auth::id()) {
            $product->delete();
            return redirect('/home')->with('succes', 'Product successfully deleted!');
        } else {
            return redirect('/home')->with('error', 'You don\'t have permission to acces this file');
        }
    }

}
