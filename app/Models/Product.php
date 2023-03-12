<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'text',
        'price',
        'amount',
        'view',
        'image',
        'metaTitle',
        'metaDescription'
    ];
    public function comments()
    {
        return $this->morphMany(Comment::class,'commenttable');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }
    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }
}
