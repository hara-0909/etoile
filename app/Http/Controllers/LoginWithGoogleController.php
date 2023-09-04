<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追加
use Laravel\Socialite\Facades\Socialite;
// 追加
use App\Models\User;
// 追加
use Illuminate\Support\Facades\Auth;
// 追加
use Exception;

class LoginWithGoogleController extends Controller
{
    // 追加
    public function redirectToGoogle()
    {
        return Socialite::driver("google")->redirect();
    }

    // 追加
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver("google")->user();
            $finduser = User::where("google_id", $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended("dashboard");
            } else {
                $newUser = User::create([
                    "name" => $user->name,
                    "email" => $user->email,
                    "google_id" => $user->id,
                    "password" => encrypt("123456dummy"),
                ]);

                Auth::login($newUser);

                return redirect()->intended("dashboard");
            }
        } catch (Exception $e) {
            \Log::error($e);
            throw $e->getMessage();
        }
    }
}