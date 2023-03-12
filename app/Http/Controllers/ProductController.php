<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('products',compact('products'));
    }
    public function singleProduct(Product $product)
    {
        $this->seo()->setTitle($product->metaTitle)->setDescription($product->metaDescription);
        $comments = $product->comments()->where('approved','1')->get();
        return view('product-single',compact('product','comments'));
    }
}
