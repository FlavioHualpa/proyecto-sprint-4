<?php

namespace App\Http\Controllers\Auth;

use App\Genre;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
      $genres = Genre::orderBy('name')->get();

      return view(
        'auth.login2',
        [ 'genres' => $genres ]
      );
    }

    protected function validateLogin(Request $request)
        {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required',
                // new rules here
            ]);
        }
}
