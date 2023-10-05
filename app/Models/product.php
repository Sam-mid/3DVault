<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Handle product creation and storage here
    }

}




