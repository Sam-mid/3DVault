<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Add this line


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric',
            'poly_count' => 'required|integer',
            'software' => 'required|string|max:255',
            'file_format' => 'required|string|max:255',
        ]);
        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
             $imagePath = str_replace('images/', '', $imagePath);}

        // Create a new product
        $product = new Product([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $imagePath,
            'price' => $validatedData['price'],
            'poly_count' => $validatedData['poly_count'],
            'software' => $validatedData['software'],
            'file_format' => $validatedData['file_format'],
        ]);


        // Get the currently authenticated user
        $user = Auth::user();

        // Associate the product with the authenticated user
        $user->products()->save($product);

        // Flash a success message
        session()->flash('success', 'Product added successfully.');

        // Redirect to a relevant page
        return redirect('/home');
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(product $product){
        $product = Product::find($product->id);

// Check if the authenticated user is the owner of the product
if (!Auth::check()) {
    return redirect()->route('home')->with('error', 'You must be logged in to delete a product.');
}

//dd($product->title,);
//dd(Auth::id() === $product->user_id);
//dd(Auth::id(), $product->user_id, $product->toArray());

if (Auth::id() === $product->user_id){
        $product->delete();
    return redirect()->route('home')->with('success', 'Product deleted successfully.');
}else{
    return redirect()->route('home')->with('error', 'You can only delete your own products.');
}
    }
}

