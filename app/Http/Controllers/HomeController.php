<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = \App\Models\Product::all();
        return view('index', compact('products'));
    }

    public function addtoCart($id)
    {
        if (Cart::create([
            'product_id' => $id,
            'user_id' => Auth::user()->id
        ])) {
            return redirect()->back()->with('success', 'the product added to cart');
        }
        return redirect()->back()->with('error', 'the product not  added to cart');
    }

    public function checkout()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('checkout', compact('carts'));
    }


}
