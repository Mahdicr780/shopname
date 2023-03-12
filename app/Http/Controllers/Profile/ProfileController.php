<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('profile.home');
    }
    public function twoFactorAuth()
    {
        return view('profile.2factor');
    }
    public function insTwoFactorAuth(Request $request)
    {
        $data = $request->validate([
            'type'=> 'required|in:off,sms',
            'phone'=>'required_unless:type,off'
        ]);
        if($data['type'] == 'sms'){
            if($request->user()->phone_number !== $data['phone']){
                return "this mobile is not verify";
            }
        }
        else{
            $request->user()->update([
                'two_factor_type' => 'sms'
            ]);
        }
        if($data['type'] == 'off'){
            $request->user()->update([
                'two_factor_type' => 'off'
            ]);
        }
        else{
            $request->user()->update([
                'two_factor_type' => 'sms'
            ]);
        }
        return back();
    }
    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id',$user->id)->first();
        $carts = Cart::where('basket_id',$orders->basket_id)->get();
        return view('profile.orders',compact('carts'));
    }
}
