<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;

class CancelPurchaseController extends Controller
{
    public function cancel(Request $request)
    {
        // バリデーション
        $request->validate([
            'product_id' => 'required|exists:purchases,product_id',
        ]);

        // ログインユーザーのIDを取得
        $userId = Auth::id();
        $productId = $request->input('product_id');

        // 購入情報を取得（statusが1でかつuser_idがログインユーザーのIDに一致するもの）
        $purchase = Purchase::where('user_id', $userId)
                            ->where('product_id', $productId)
                            ->where('status', 1) // 未配送
                            ->first();

        // 購入情報が見つからない場合
        if (!$purchase) {
            return redirect()->route('purchase.index')->with('error', 'キャンセルできる購入情報が見つかりません。');
        }

        // 購入情報のステータスをキャンセルに変更
        $purchase->status = 4; // キャンセル
        $purchase->save();

        return redirect()->route('purchase.index')->with('success', '購入情報をキャンセルしました。');
    }
}