<?php

namespace App;

use App\Book;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [ 'user_id' ];
    
    public function books()
    {
      return $this->belongsToMany(Book::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
