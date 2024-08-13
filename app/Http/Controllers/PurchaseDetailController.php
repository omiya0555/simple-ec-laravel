<?php

namespace App\Http\Controllers;

use App\Models\PurchaseDetail;
use App\Models\PurchaseItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseDetailController extends Controller
{
    /**
     * ログインユーザーの購入明細一覧を表示します。
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = Auth::id();
        $purchaseDetails = PurchaseDetail::where('user_id', $userId)
            ->with('purchaseItems')
            ->orderBy('created_at', 'desc') // 作成日時で降順に並び替え
            ->get();

        // カートが空の場合
        if ($purchaseDetails->isEmpty()) {
            return view('purchase_details.index')->with('message', '購入された商品はありません。');
        }

        return view('purchase_details.index', compact('purchaseDetails'));
    }

    /**
     * カートから購入明細を作成し、購入アイテムも挿入します。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        
        // ユーザーのカートアイテムを取得
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        // カートアイテムの合計金額を計算
        $totalAmount = 0;
        foreach ($cartItems as $c) {
            $totalAmount =+ $c->product->price;
        }

        // 購入明細を作成
        $purchaseDetail = PurchaseDetail::create([
            'total_amount' => $totalAmount,
            'user_id' => $userId,
        ]);

        // 購入アイテムを作成
        foreach ($cartItems as $item) {
            PurchaseItem::create([
                'purchase_detail_id' => $purchaseDetail->id,
                'product_id' => $item->product_id,
                'product_price' => $item->product->price, // Product モデルの価格を利用
                'product_image_path' => $item->product->image_path,
                'product_title' => $item->product->title,
                'product_description' => $item->product->description,
                'status' => 1, // 初期ステータスは未配送
            ]);
        }

        // カートアイテムを削除（購入後にカートをクリア）
        Cart::where('user_id', $userId)->delete();

        return redirect()->route('purchase_details.index')->with('success', '商品の購入処理が完了しました。');
    }
}