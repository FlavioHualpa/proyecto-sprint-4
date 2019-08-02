<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
  protected $table = 'languages';
  protected $fillable = [ 'name' ];

  public function books()
  {
    return $this->hasMany(Book::class);
  }
}
