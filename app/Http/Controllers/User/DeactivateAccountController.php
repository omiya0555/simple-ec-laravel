<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DeactivateAccountController extends Controller
{
    /**
     * 退会確認画面を表示
     */
    public function confirm()
    {
        return view('user.confirm_deactivation');
    }

    /**
     * 退会処理を実行
     */
    public function deactivate(Request $request)
    {
        // バリデーション
        $request->validate([
            'password' => 'required|current_password', // 現在のパスワードを確認
        ]);

        // ユーザーを取得
        $user = Auth::user();

        // ユーザーを削除
        $user->delete();

        // ログアウト
        Auth::logout();

        // リダイレクト
        return redirect()->route('/')->with('success', 'アカウントが正常に削除されました。');
    }
}
