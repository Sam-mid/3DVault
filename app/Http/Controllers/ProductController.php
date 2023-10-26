<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
        $user = auth()->user();

        if ($user->role === 'user' && $user->likedProducts->count() < 5) {
            return redirect()->route('home')->with('error', 'You need to like at least 5 products before you can create a new one.');
        }

        // Ga door met de normale create-functie om een nieuw product aan te maken
        return view('create');
    }




    public function search(Request $request)
    {
        $query = $request->input('search');
        $software = $request->input('software');
        $file_format = $request->input('$file_format');
        $priceRange = $request->input('price_range');

        $products = Product::query();

        if (!empty($query)) {
            $products->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', '%' . $query . '%')
                    ->orWhere('description', 'like', '%' . $query . '%');
            });
        }

        if (!empty($software)) {
            $products->where('software', $software);
        }

        if (!empty($file_format)) {
            $products->where('file_format', $file_format);
        }

        if (!empty($priceRange)) {
            $priceRangeArray = explode('-', $priceRange);
            $minPrice = $priceRangeArray[0];
            $maxPrice = $priceRangeArray[1];
            $products->whereBetween('price', [$minPrice, $maxPrice]);
        }

        $products = $products->get();

        $hasLiked = [];

        if (Auth::check()) {
            $user = Auth::user();
            foreach ($products as $product) {
                $hasLiked[$product->id] = $user->hasLiked($product);
            }
        }

        // Laad de view en geef $products en $hasLiked door aan de view
        return view('home', compact('products', 'hasLiked'));

    }


    public function admin()
    {

        if (auth()->user()->role === 'admin') {
            $products = Product::all();
            return view('admin', compact('products'));
        } else {
            return redirect()->route('home')->with('error', 'only admins can access this page.');
        }


    }

    public function toggle(Product $product)
    {
        $product->status = ($product->status == 1) ? 0 : 1;
        $product->save();

        return back()->with('success', 'Product status toggled successfully.');
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
        return view('show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'You must be logged in to edit a product.');
        }

        // Check if the authenticated user is the owner of the product
        if (auth()->user()->id === $product->user_id || auth()->user()->role === 'admin') {
            return view('edit', compact('product'));
        } else {
            return redirect()->route('home')->with('error', 'You can only edit your own products.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'You must be logged in to update a product.');
        }

        // Check if the authenticated user is the owner of the product
        if (auth()->user()->id === $product->user_id || auth()->user()->role === 'admin') {
            // Validate the form data
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Allow image update, but it's not required
                'price' => 'required|numeric',
                'poly_count' => 'required|integer',
                'software' => 'required|string|max:255',
                'file_format' => 'required|string|max:255',
            ]);

            // Handle file upload
            if ($request->hasFile('image')) {
                // Store the new image
                $imagePath = $request->file('image')->store('images', 'public');
                $imagePath = str_replace('images/', '', $imagePath);
                $product->image = $imagePath;
            }

            // Update the product
            $product->title = $validatedData['title'];
            $product->description = $validatedData['description'];
            $product->price = $validatedData['price'];
            $product->poly_count = $validatedData['poly_count'];
            $product->software = $validatedData['software'];
            $product->file_format = $validatedData['file_format'];

            $product->save();

            // Redirect to a relevant page with a success message
            return redirect('/home')->with('success', 'Product updated successfully.');
        } else {
            return redirect()->route('home')->with('error', 'You can only update your own products.');
        }
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

        if (auth()->user()->id === $product->user_id || auth()->user()->role === 'admin'){
        $product->delete();
    return redirect()->route('home')->with('success', 'Product deleted successfully.');
}else{
    return redirect()->route('home')->with('error', 'You can only delete your own products.');
}
    }


    public function like(Product $product)
    {

        $user = auth()->user();

        if (!$user->likes()->where('product_id', $product->id)->exists()) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->product_id = $product->id;
            $like->save();

            return redirect()->back(); // Of naar de lijst met producten
        }

        return redirect()->route('home')->with('error', 'You already liked this product.');
    }

    public function unlike(Product $product)
    {
        $user = auth()->user();

        $like = $user->likes()->where('product_id', $product->id)->first();

        if ($like) {
            $like->delete();
            return redirect()->route('home')->with('success', 'Product unliked.');
        }

        return redirect()->route('home')->with('error', 'You have not liked this product.');
    }


    public function likedProducts()
    {
        $likedProducts = auth()->user()->likedProducts()->paginate(10);
        return view('liked-products', compact('likedProducts'));
    }

    public function hasLiked(Product $product)
    {
        return $this->likes->contains('id', $product->id);
    }

}

