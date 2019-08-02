<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table = 'genres';
    protected $fillable = 'name';

    public function books()
    {
      return $this->hasMany(Book::class);
    }
}
