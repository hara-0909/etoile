<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    //
    

public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect();
}

public function handleGoogleCallback()
{
    $user = Socialite::driver('google')->user();

    // $user にはGoogleから取得したユーザーデータが含まれます
    // ユーザーデータを利用してユーザーの登録やログイン処理を実装します

    return redirect('/home'); // ログイン後のリダイレクト先
}

}
