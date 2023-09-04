<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Movecontroller; //menuDetail
use App\Http\Controllers\UserlistController; //管理者画面
use App\Http\Controllers\UserController;

//Googleログイン
use App\Http\Controllers\LoginWithGoogleController;


//パスワードリセット
// use App\Http\Controllers\Auth\ResetPasswordController; 
// use App\Http\Controllers\PasswordController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
//予約
use App\Http\Controllers\ReservationController; 


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('etoile/index');
});
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'
])->name('home');

// 施術詳細画面の表示
Route::get('Étoile/menuDetail', [MoveController::class, 'menuDetail'
])->name('menuDetail');

// トップ画面へ(etoile/index)
Route::get('/', [MoveController::class, 'Top'
])->name('Top');

// トップ画面から管理者画面へ
Route::get('/admin/Login', [MoveController::class, 'Toadmin'
])->name('Toadmin');

// 管理者新規登録
Route::get('/admin/register', [\App\Http\Controllers\RegisterController::class, 'adminRegisterForm'
])
->middleware('auth:admin');
Route::post('/admin/register', [\App\Http\Controllers\RegisterController::class, 'adminRegister'
])->name('admin.register');
// ->middleware('auth:admin')->name('admin.register');

// 管理者ログイン(adminLogin)
Route::get('/admin/login', function () {
    return view('adminLogin'); });
Route::post('/admin/login', [\App\Http\Controllers\LoginController::class, 'adminLogin'
])->name('admin.login')->middleware('guest:admin');

// 管理者ログアウト
Route::get('/admin/logout', [\App\Http\Controllers\LoginController::class, 'adminLogout'
])->name('admin.logout');

// 管理者ログイン中
Route::get('/admin/dashboard', function () {
    return view('adminDashboard');
})->middleware('auth:admin');
        // 予約一覧画面へ遷移
        Route::get('/reservations',[MoveController::class, 'reservations'])->name('reservations');
        // 予約一覧表示
        Route::get('/reservations',[ReservationController::class, 'reservations'])->name('reservations');
        //削除
        Route::get('/admin_delete/{id?}', [ReservationController::class,'admin_delete'])-> name('delete');

        Route::put('/update/{id?}', [ReservationController::class, 'update'])->name('update');
        // 編集
        Route::get('/edit/{id?}',[ReservationController::class,'edit'])->name('edit');
        // 編集完了
        Route::post('/update/{id?}',[ReservationController::class,'update'])->name('update');
        // 一覧から管理者画面へ戻る
        Route::get('/adminDashboard',[MoveController::class, 'adminDashboard'])->name('admin.Dashboard');

// 管理者画面：会員一覧画面へ
Route::get('/userlist', [MoveController::class, 'userlist'
    ])->middleware('auth:admin')->name('userlist');

        // 会員一覧表示
        Route::get('/userlist', [UserlistController::class, 'index'])->name('userlist');
        //削除
        Route::get('/delete_user/{id?}', [UserlistController::class,'delete_user'])-> name('delete_user');
        // 一覧から管理者画面へ戻る
        Route::get('/adminDashboard',[MoveController::class, 'adminDashboard'])->name('admin.Dashboard');

// 
Route::get('/admin/Reservation', [MoveController::class, 'adminRegister_login'
])->name('adminRegister_login');

// パスワードリセット
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');})->middleware('guest')->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);})->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);})->middleware('guest')->name('password.reset');
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);})->middleware('guest')->name('password.update');

// Googleログインリダイレクト
// 追加
Route::get("auth/google", [
    LoginWithGoogleController::class,
    "redirectToGoogle",
  ]);
  
  // 追加
  Route::get("auth/google/callback", [
    LoginWithGoogleController::class,
    "handleGoogleCallback",
  ]);
  

// 予約
Route::prefix('/reservation')->middleware('auth')->group(function(){

    Route::get('/dashboard', [MoveController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('/', [ReservationController::class, 'index'])->name('reservation.index');
    Route::get('/reservation_list', [ReservationController::class, 'reservation_list'])->name('reservation.reservation_list');
    Route::post('/', [ReservationController::class, 'store'])->name('reservation.store');

});

Route::get('/delete/{id?}', [ReservationController::class,'reservation_delete'])-> name('reservation_delete');
Route::get('/dashboard', [ReservationController::class, 'user_reservation'])->name('user_dashboard');

        // 予約一覧表示
        // Route::get('/dashboard', [ReservationController::class, 'user_reservation'])->name('user.dashboard');

// ログイン画面
// Route::get('/login', [MoveController::class, 'login'])->name('login');

// 会員退会
Route::post('/deactivateAccount/{userId}', [UserController::class, 'deactivateAccount'])->name('deactivateAccount');

Route::get('/etoile/index', function () {
    return view('etoile/index');
})->name('etoile.index');
