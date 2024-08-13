<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Models\Purchase;
use App\Models\Product;

class PurchaseController extends Controller
{
    public function purchase(Request $request)
    {
        // トランザクション開始
        DB::beginTransaction();

        try {
            // ログインユーザーのIDを取得
            $userId = Auth::id();

            // カートの中身を取得
            $cartItems = Cart::where('user_id', $userId)->get();

            // カートが空の場合は何もしない
            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'カートに商品がありません。');
            }

            // カートの中身をpurchasesテーブルに追加
            foreach ($cartItems as $cartItem) {
                $product = Product::find($cartItem->product_id);

                Purchase::create([
                    'user_id' => $userId,
                    'product_id' => $product->id,
                    'status' => 1, // 初期値として1を設定
                    'title' => $product->title,
                    'description' => $product->description,
                    'price' => $product->price,
                    'image_path' => $product->image_path,
                ]);
            }

            // カートの中身をクリア
            Cart::where('user_id', $userId)->delete();

            // トランザクションのコミット
            DB::commit();

            return redirect()->route('purchase.index')->with('success', '購入が完了しました。');
        } catch (\Exception $e) {
            // トランザクションのロールバック
            DB::rollBack();
            dd($e);
            return redirect()->route('cart.index')->with('error', '購入処理に失敗しました。');
        }
    }
}
