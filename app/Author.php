<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
  protected $table = 'authors';
  protected $fillable = ['first_name', 'last_name'];

  public function fullName()
  {
    return $this->first_name . ' ' . $this->last_name;
  }

  public function books()
  {
    return $this->hasMany(Book::class);
  }
}
