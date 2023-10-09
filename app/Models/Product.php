<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'poly_count',
        'software',
        'file_format',
    ];

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




