<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallback()
    {
        $socialUser = Socialite::driver('google')->user();
        $user = User::firstOrNew(['email' => $socialUser->getEmail()]);
        if ($user->exists()) {
            Auth::login($user);
            return response()->json([], 201);
        }
        $user->name = $socialUser->getName();
        // $user->save();
        Auth::login($user);
        return response()->json([], 201);
    }
}
