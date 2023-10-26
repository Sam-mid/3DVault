<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::where('status', 1)->get();
        $hasLiked = [];

        if (Auth::check()) {
            $user = Auth::user();
            foreach ($products as $product) {
                $hasLiked[$product->id] = $user->hasLiked($product);
            }
        }

        return view('home', compact('products', 'hasLiked'));
    }

}
