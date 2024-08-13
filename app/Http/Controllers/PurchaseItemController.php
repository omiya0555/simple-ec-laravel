<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseItemController extends Controller
{
    /**
     * ログインユーザーに紐づく購入明細のIDに紐づく購入商品一覧を表示します。
     *
     * @param  int  $purchaseDetailId
     * @return \Illuminate\Http\Response
     */
    public function index($purchaseDetailId)
    {
        $userId = Auth::id();
        $purchaseItems = PurchaseItem::whereHas('purchaseDetail', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->where('purchase_detail_id', $purchaseDetailId)->get();

        return view('purchase_items.index', compact('purchaseItems'));
    }

    /**
     * カートの内容を購入商品として保存します。
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cartItems = $request->input('cart_items'); // カートアイテムのデータが含まれていると仮定

        // カートアイテムを購入アイテムとして保存
        foreach ($cartItems as $item) {
            PurchaseItem::create([
                'purchase_detail_id' => $item['purchase_detail_id'],
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'product_price' => $item['product_price'],
                'product_image_path' => $item['product_image_path'],
                'product_title' => $item['product_title'],
                'product_description' => $item['product_description'],
                'status' => 1, // 初期ステータスは未配送
            ]);
        }

        // ステータスを1から4に変更（例: 支払い完了）
        $purchaseDetail = PurchaseDetail::findOrFail($request->input('purchase_detail_id'));
        if ($purchaseDetail->status == 1) {
            $purchaseDetail->update(['status' => 4]);
        }

        return redirect()->route('purchase_items.index', ['purchaseDetailId' => $request->input('purchase_detail_id')])->with('success', 'Purchase items created successfully.');
    }

    /**
     * 購入商品を更新します。
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseItem $purchaseItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'product_price' => 'required|numeric',
            'status' => 'required|integer|between:1,4',
        ]);

        $purchaseItem->update($request->all());

        return redirect()->route('purchase_items.index', ['purchaseDetailId' => $purchaseItem->purchase_detail_id])->with('success', 'Purchase item updated successfully.');
    }

    /**
     * 購入商品を削除します。
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseItem $purchaseItem)
    {
        $purchaseItem->delete();

        return redirect()->route('purchase_items.index', ['purchaseDetailId' => $purchaseItem->purchase_detail_id])->with('success', 'Purchase item deleted successfully.');
    }
}
