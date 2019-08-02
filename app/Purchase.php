<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
  protected $table = 'purchases';

  public function books()
  {
    return $this->belongsToMany(Book::class);
  }

}
