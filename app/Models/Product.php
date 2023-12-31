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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function likedBy()
    {
        return $this->belongsToMany(User::class, 'likes', 'product_id', 'user_id');
    }


}







