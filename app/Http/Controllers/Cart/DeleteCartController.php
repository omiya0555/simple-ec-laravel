<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class DeleteCartController extends Controller
{
    public function delete(Request $request)
    {
        // バリデーション
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);

        // ログインユーザーのIDを取得
        $userId = Auth::id();
        $cartId = $request->input('cart_id');

        // カートアイテムを削除
        $cartItem = Cart::where('user_id', $userId)
                        ->where('id', $cartId)
                        ->first();

        // カートアイテムが存在しない場合
        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', '削除できるカートアイテムが見つかりません。');
        }

        // カートアイテムを削除
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'カートアイテムを削除しました。');
    }
}