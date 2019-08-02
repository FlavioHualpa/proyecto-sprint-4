<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
  protected $table = 'publishers';
  protected $fillable = [ 'name' ];

  public function books()
  {
    return $this->hasMany(Book::class);
  }

}
