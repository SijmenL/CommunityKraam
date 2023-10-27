<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditProductController extends Controller
{
    public function show($id)
    {
        $product = Product::find($id);

        $this->authorize('view', $product);

        $tags = Tag::all();
        $selectedTags = $product->tags->pluck('id')->toArray();

        return view('products.edit', compact('product', 'tags', 'selectedTags'));
    }


    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'mimes:jpeg,png,jpg,gif,webp',
            'valuta' => 'required|string',
            'tags' => 'array',
        ]);

        // Find the product by ID
        $product = Product::find($id);

        $this->authorize('view', $product);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Update product data
        $product->title = $request->input('title');
        $product->subtitle = $request->input('subtitle');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->valuta = $request->input('valuta');
        $product->private = 0;

        // Handle image update
        if ($request->hasFile('image')) {
            $newPictureName = time() . '-' . $request->title . '.' . $request->image->extension();
            $destinationPath = 'product_images';
            $request->image->move($destinationPath, $newPictureName);
            $product->image = $newPictureName;
        }

        $product->save();

        // Sync the tags with the product
        $product->tags()->sync($request->input('tags'));

        return redirect()->route('home')->with('success', 'Product updated successfully!');
    }
}
