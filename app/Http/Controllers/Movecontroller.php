<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Reservation;
use Illuminate\Support\Facades\DB;

class Movecontroller extends Controller
{


    /*public function user(Request $request)
    {
        return view('user');
    }*/

    // 詳細画面へ
    public function menuDetail(Request $request)
    {
        return view('etoile/menuDetail');
    }
    // トップ画面へ
    public function Top(Request $request)
    {
        return view('etoile/index');
    }
    public function login(Request $request)
    {
        return view('login');
    }

    public function userReservation(Request $request)
    {
        return view('userReservation');
    }

    // トップ画面から管理者画面へ
    public function Toadmin(Request $request) {
        return view('adminLogin');
    }
        // 管理者画面へ
        public function adminDashboard(Request $request)
        {
            return view('adminDashboard');
        }
        // 会員一覧画面へ
        public function userlist(Request $request)
        {
            return view('userlist');
        }
        // 予約一覧画面へ
        public function reservations(Request $request)
        {
            return view('reservations');
        }
        // 管理者新規登録画面から管理者ログイン画面へ
        public function adminRegister_login(Request $request)
        {
            return view('adminLogin');
        }

    // 会員画面へ
    public function userDashboard(Request $request)
    {
        $user = Auth::user(); // ログイン中のユーザーを取得
        $reservations = DB::table('reservations')
                ->where('user_id', $user->id)
                ->select('reservations.id', 'reservations.room_id', 'users.name', 'reservations.starts_at', 'reservations.created_at')
                ->join('users', 'users.id', '=', 'reservations.user_id')
                ->get();
        return view('dashboard', compact('reservations'));
    }
}
