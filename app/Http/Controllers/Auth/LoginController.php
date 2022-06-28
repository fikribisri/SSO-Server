<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {

        $user_id = Auth()->user()->id;
        // revoke by token
        // $token= $request->user()->tokens->find($id);
        // $token->revoke();

        // all remove token by user
        \DB::table('oauth_access_tokens')
            ->where('user_id', $user_id)
            ->delete();

        // remove all the sessionIds related to the current user
        \DB::table('sessions')
            ->where('user_id', $user_id)
            ->delete();

        \DB::table('oauth_auth_codes')
            ->where('user_id', $user_id)
            ->delete();


        Auth::logout();

        return redirect(route('login'));
    }
}
