<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateProductController extends Controller
{
    public function view()
    {
        $tags = Tag::all(); // Retrieve tags from the database
        return view('products.create', compact('tags'));
    }

    public function store(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'image' => 'required|mimes:jpeg,png,jpg,gif,webp',
            'valuta' => 'required|string',
            'tags' => 'array',
        ]);

        // Process and save the uploaded image
        $newPictureName = time() . '-' . $request->title . '.' . $request->image->extension();
        $destinationPath = 'product_images';

        if ($request->image->move($destinationPath, $newPictureName)) {
            // File was moved successfully

            // Add the product_owner field with the current user's ID
            $validatedData['product_owner'] = Auth::id();

            $validatedData['private'] = 0;


            $validatedData['image'] = $newPictureName;

            // Create the product
            $product = Product::create($validatedData);

            // Attach tags to the product if tags were provided
            if (!empty($request->tags)) {
                $product->tags()->attach($request->tags);
            }

            return redirect('/home')->with('success', 'Data added successfully!');
        } else {
            // File move failed
            return redirect('/home')->with('error', 'Failed to upload the file.');
        }
    }

}
