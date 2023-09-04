<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserlistController extends Controller
{
    public function index() {
        $users = DB::table('users')->select('id', 'name', 'email', 'created_at')->get();
		return view('userlist', compact('users'));
    }

    // データ削除
    public function delete_user(Request $request){

        $id = $request->id;

        // そのユーザーの予約も削除
        DB::table('reservations')->where('user_id', $id)->delete();
    
        // ユーザー削除
        User::where('id', $id)->delete();
    
        return redirect()->route('userlist');  // この行が userlist にリダイレクトします
    
    }
}