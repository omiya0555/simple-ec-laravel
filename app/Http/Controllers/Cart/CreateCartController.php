<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CreateCartController extends Controller
{
    public function __invoke(Request $request){
        // バリデーション
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // ログインユーザーのIDを取得
        $userId = Auth::id();

        // カートに商品を追加
        Cart::create([
            'user_id' => $userId,
            'product_id' => $request->input('product_id'),
        ]);

        // リダイレクト先を指定（例えばカートページ）
        return redirect()->route('ecapp.index')->with('success', '商品をカートに追加しました。');
    }
}
