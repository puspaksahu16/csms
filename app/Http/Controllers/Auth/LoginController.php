<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();

    }
    public function redirectToProviderGoogle()
    {

        return Socialite::driver('google')->redirect();
    }


    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();
        dd($user);
        //storing

        $user = User::firstOrCreate([
            'name'=>$user->getName(),
            'email'=>$user->getEmail(),
            'provider_id'=>$user->getId(),
        ]);
        Auth::Login($user,true);

    }
    public function handleProviderCallbackGoogle()
    {

        $user1 = Socialite::driver('google')->user();

        dd($user1);
        //storing


        $user1 = User::firstOrCreate([
            'name'=>$user1->getName(),
            'email'=>$user1->getEmail(),
            'provider_id'=>$user1->getId(),
        ]);
        Auth::Login($user1,true);
        return redirect('/dashboard');
    }
}
