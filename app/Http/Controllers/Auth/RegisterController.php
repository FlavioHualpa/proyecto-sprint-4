<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Genre;
use App\Cart;
use App\Country;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use \Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:80', 'unique:users'],
            'country_id' => ['required', 'exists:countries,id'],
            'birth_date' => ['required', 'before:-18 years'],
            'sex' => ['required', 'in:f,m'],
            'avatar_url' => ['file', 'image'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'terms' => ['accepted'],
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // dd($this->redirectPath());
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);
        //$this->create($request->all());
        return redirect($this->redirectPath());

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
      if (isset($data['avatar'])) {
        $url = $data['avatar']->store('public/avatars');
        $url = basename($url);
      }
      else {
        $url = null;
      }

      $user = User::create([
          'first_name' => $data['first_name'],
          'last_name' => $data['last_name'],
          'email' => $data['email'],
          'country_id' => $data['country_id'],
          'birth_date' => $data['birth_date'],
          'sex' => $data['sex'],
          'avatar_url' => $url,
          'password' => Hash::make($data['password']),
      ]);

      $cart = Cart::create([
        'user_id' => $user->id
      ]);

      return $user;
    }

    public function showRegistrationForm()
    {
      $countries = Country::orderBy('name')->get();
      $genres = Genre::orderBy('name')->get();

      return view(
        'auth.register2',
        [ 'countries' => $countries,
          'genres' => $genres
        ]
      );
    }
}
