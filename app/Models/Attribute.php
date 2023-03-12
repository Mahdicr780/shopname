<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function Values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
