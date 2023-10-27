<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListController extends Controller
{
    public function createList()
    {
        $user = Auth::id();

        $totalProducts = Product::where('product_owner', $user)->count();

        if ($totalProducts >= 2) {
            return view('cataloges.create');
        } else {
            return redirect('/home')->with('error', 'You need to have at least 2 products to create a list.');
        }
    }

    public function storeList(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $validatedData['user_id'] = Auth::id();

        $catalog = Catalog::create($validatedData);

        return redirect('/home')->with('success', 'List added successfully!');
    }

    public function editList($id)
    {
        $list = Catalog::find($id);

        return view('cataloges.edit', compact('list'));
    }

    public function updateList(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $list = Catalog::find($id);

        $list->name = $request->input('name');
        $list->description = $request->input('description');

        $list->save();

        return redirect()->route('home')->with('success', 'List updated successfully!');

    }

    public function deleteList($id)
    {
        $list = Catalog::find($id);

        $list->delete();
        return redirect('/home')->with('succes', 'List successfully deleted!');
    }


    public function viewList($id)
    {
        // Retrieve the catalog based on the provided ID
        $catalog = Catalog::find($id);

        if (!$catalog) {
            abort(404); // Handle the case where the catalog with the given ID is not found
        }

        // Retrieve the products associated with the catalog
        $products = $catalog->products;

        return view('cataloges.view', compact('products', 'catalog'));
    }

    public function removeProductFromList(Product $product, Catalog $list)
    {
        // Ensure that the product is associated with the specified list
        if (!$list->products->contains($product)) {
            return redirect()->back()->with('error', 'Product not found in the list.');
        }

// Remove the product from the list
        $list->products()->detach($product);

        return redirect()->back()->with('success', 'Product removed from the list.');
    }
}
