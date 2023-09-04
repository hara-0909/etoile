<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function index() {

        $rooms = Room::select('id', 'name', 'time_steps')->get();

        return view('reservation.index')->with([
            'rooms' => $rooms
        ]);

    }

    // 画面遷移
    public function create(Request $request) {
        return view('reservation/index');
    }

    public function store(Request $request) {

        // TODO: バリデーションは省略しています

        $reservation = new Reservation();
        $reservation->user_id = auth()->id();
        $reservation->room_id = $request->room_id;
        $reservation->starts_at = $request->start_at;
        $result = $reservation->save();

        return ['result' => $result];

    }

    public function reservation_list(Request $request) {

        $reservations = Reservation::select('id', 'room_id', 'starts_at')
            ->whereDate('starts_at', $request->date)
            ->get();

        return [
            'reservations' => $reservations
        ];

    }
    // 会員画面、予約表示
    public function user_reservation()
    {
        $user = Auth::user(); // ログイン中のユーザーを取得
        $reservations = DB::table('reservations')
                ->where('user_id', $user->id)
                ->select('reservations.id', 'reservations.room_id', 'users.name', 'reservations.starts_at', 'reservations.created_at')
                ->join('users', 'users.id', '=', 'reservations.user_id')
                ->get();
            return view('dashboard', compact('reservations'));
    }
    // データ削除
    public function reservation_delete(Request $request){
        $id = $request->id;
        Reservation::where('id', $id)->delete();
        return redirect('reservation/dashboard');
    }


    // 管理者画面
    //予約一覧表示 
    
    public function reservations() {
        $today = Carbon::today(); 
        
        $reservations = DB::table('reservations')->select('reservations.id', 'reservations.room_id', 'users.name', 'reservations.starts_at', 'reservations.created_at')
                        ->join('users', 'users.id', '=', 'reservations.user_id')
                        ->where('reservations.starts_at', '>=', $today) 
                        ->orderBy('reservations.starts_at', 'asc')
                        ->get();
		return view('reservations', compact('reservations'));
    }

            // 編集 get
            public function edit(Request $request) {
                $id = $request->id;
                $reservations = Reservation::find($id);
                return view('edit',['reservations' => $reservations]);
            }
            // 更新処理
            public function update(Request $request, $id)
            {
                $request->validate([
                    'room_id' => 'required',
                    'starts_at' => 'required',
                    // 他のバリデーションルール
                ]);
                
                $reservations = Reservation::find($id);
                $reservations->update([
                    'name' => $request->input('name'),
                    'room_id' => $request->input('room_id'),
                    'starts_at' => $request->input('starts_at'),
                    // 他のフィールドもここに追加
                ]);
                return view('update');

            }
            // 予約削除
            public function admin_delete($id){
                Reservation::where('id', $id)->delete();
                return redirect('reservations');
            }
            
            // データ削除
            /*public function delete(Request $request){
                $id = $request->id;
                User::where('id', $id)->delete();
                return redirect('reservations');
            }*/

}

