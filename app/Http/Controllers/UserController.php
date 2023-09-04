<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // 追加


class UserController extends Controller
{
    public function deactivateAccount(Request $request) {
    $userId = Auth::id();  // ログインしているユーザーのIDを取得
        if (Auth::check()) {
            // ユーザーを取得
            $user = User::find($userId);
    
            if (!$user) {
                return redirect()->back()->with('error', 'ユーザーが見つかりませんでした。');
            }
    
            // ユーザーに関連する予約を削除
            $user->reservations()->delete();
    
            // ユーザーを削除
            $user->delete();
    
            // ユーザーをログアウトさせる
            Auth::logout();
    
            // リダイレクト
            return redirect()->route('etoile.index')->with('success', 'アカウントが正常に削除されました。');
        } else {
            // ログインしていない場合の処理を記述（例えばログインページにリダイレクトなど）
                    // ログインしていない場合、ログインページにリダイレクト
            return redirect('login')->with('success', 'ログインを行なってください。');
        }
    }
    

}


