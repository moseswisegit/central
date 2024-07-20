<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use App\User;
use Illuminate\Http\Request;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    // protected $redirectTo = '/admin/home';
    protected $redirectTo = '/dashboard/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
            protected function attemptLogin(Request $request)
            {
                $identifiant  = $request->input('identifiant');
                $password = $request->input('password');

                $credentials = filter_var($identifiant, FILTER_VALIDATE_EMAIL) ? 
                    ['email' => $identifiant , 'password' => $password] : 
                    ['identifiant' => $identifiant , 'password' => $password];

                return $this->guard()->attempt($credentials, $request->filled('remember'));
            }


    /**
     * Get the login identifiant to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'identifiant';
    }
}
