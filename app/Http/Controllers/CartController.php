<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count = DB::table('carts')->count();
        if ($count == 0) {
            return view('carts2');
        }
        else{
            $products = DB::table('carts')->where('user_id', auth()->user()->id)->get();
            return view('cart', compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $isCard = DB::table('carts')->where('user_id', auth()->user()->id)->first();
        $basket = DB::table('baskets')->where('user_id', auth()->user()->id)->where('isActive', '=', 1)->first();
        if (isset($basket)) {
            $basket_id = $basket->id;
            $basket = DB::table('baskets')->where('user_id', auth()->user()->id)->update(['price' => $basket->price + $product->price]);
        } else {
            $basket = Basket::create([
                'user_id' => auth()->user()->id,
                'price' => $product->price
            ]);
            $basket_id = $basket->id;
        }
        Cart::create([
            'user_id' => auth()->user()->id,
            'basket_id' => $basket_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        $basket = DB::table('baskets')->where('user_id', auth()->user()->id)->where('isActive', '=', 1)->first();
        if ($cart->product->quantity == null || $cart->product->quantity == 1) {
            $basket = DB::table('baskets')->where('user_id', auth()->user()->id)->update(['price' => $basket->price - $cart->product->price]);
        } else {
            $basket = DB::table('baskets')->where('user_id', auth()->user()->id)->update(['price' => $basket->price - ($cart->quantity * $cart->product->price)]);
        }
        $cart->delete();
        return back();
    }
}
