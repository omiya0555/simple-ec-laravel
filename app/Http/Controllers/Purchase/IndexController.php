<!-- <?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Purchase;

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
        $userId = Auth::id();
        // ユーザーに紐づく購入履歴を取得
        $purchases = Purchase::where('user_id', $userId)->get();
        
        // カートが空の場合
        if ($purchases->isEmpty()) {
            return view('purchase.index')->with('message', '購入した商品がありません。');
        }
        return view('purchase.index',compact('purchases'));
    }
} -->
