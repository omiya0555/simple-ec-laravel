<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth; 
use App\Models\Cart;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $cartItems = Cart::where('user_id', Auth::id())
            ->with('product')
            ->get();

        // カートが空の場合
        if ($cartItems->isEmpty()) {
            return view('cart.index')->with('message', 'カートに商品が存在しません。');
        }

        return view('cart.index', compact('cartItems'));
    }
}