<?php

namespace App;

use App\Country;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'country_id', 'birth_date', 'sex', 'avatar_url', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function country()
    {
      return $this->belongsTo(Country::class);
    }

    public function favorites()
    {
      return $this->belongsToMany(Book::class, 'favorites', 'user_id', 'book_id');
    }

    public function carts()
    {
      return $this->hasMany(Cart::class);
    }

    public function purchases()
    {
      return $this->hasMany(Purchase::class);
    }

    public function hasFavorite(Book $book)
    {
      return $this->favorites->contains('id', $book->id);
    }
}
