<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\User;
use App\Genre;
use App\Country;

class EditProfileController extends Controller
{
  public function edit()
  {
    $user = auth()->user();
    $genres = Genre::orderBy('name')->get();
    $countries = Country::orderBy('name')->get();

    return view(
      'auth.edit',
      [
        'countries' => $countries,
        'genres' => $genres,
        'user' => $user
      ]
    );
  }

  protected function validator(array $data)
  {
    return Validator::make($data, [
      'first_name' => ['required', 'string', 'max:50'],
      'last_name' => ['required', 'string', 'max:50'],
      'email' => ['required', 'string', 'email', 'max:80', Rule::unique('users')->ignore(auth()->user()->id)],
      'country_id' => ['required', 'exists:countries,id'],
      'birth_date' => ['required', 'before:-18 years'],
      'sex' => ['required', 'in:f,m'],
      'avatar' => ['file', 'image'],
    ]);
  }

  public function update(Request $request)
  {
    $this->validator($request->all())->validate();
    $user = auth()->user();

    if ($request->avatar) {
      $url = $request->avatar->store('/public/avatars');
      $url = basename($url);
    }
    else {
      $url = $user->avatar_url;
    }

    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;
    $user->country_id = $request->country_id;
    $user->birth_date = $request->birth_date;
    $user->sex = $request->sex;
    $user->avatar_url = $url;
    $user->updated_at = date('Y-m-d H:i:s');
    $user->save();

    return redirect('/');
  }
}
