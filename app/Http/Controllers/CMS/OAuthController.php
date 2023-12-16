<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Trait\Service;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    use Service;
    public function redirect_Google($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback_Google($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $isExist = User::where('email', '=', $getInfo->email)->count();

        if ($isExist == 0) {
            $user = $this->createUser($getInfo, $provider);
            Auth::login($user);
            return redirect()->route('home');
        }

        $auth = User::where('email', $getInfo->email)->first();
        Auth::login($auth);
        return redirect()->route('home');
    }

    public function redirect_Linkedin($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback_Linkedin($provider)
    {
        $getInfo = Socialite::driver($provider)->user();
        $isExist = User::where('email', '=', $getInfo->email)->count();

        if ($isExist == 0) {
            $user = $this->createUser($getInfo, $provider);
            Auth::login($user);
            return redirect()->route('home');
        }

        $auth = User::where('email', $getInfo->email)->first();
        Auth::login($auth);
        return redirect()->route('home');
    }
}
