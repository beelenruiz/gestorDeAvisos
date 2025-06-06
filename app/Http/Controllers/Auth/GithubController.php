<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GithubController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $githubUser = Socialite::driver('github')->user();

        $user = User::updateOrCreate([
            'socialite_id' => $githubUser->id,
        ], [
            'name' => $githubUser->name,
            'email' => $githubUser->email,
            'socialite_token' => $githubUser->token,
            'socialite_refresh_token' => $githubUser->refreshToken,
        ]);

        if (!$user -> company){
            $user->company()->create([
                'phone' => '',
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard');
    }

}
