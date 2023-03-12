<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'status',
        'price',
        'basket_id',
        'delivery'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
}