<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $table = 'books';

  public function genre()
  {
    return $this->belongsTo(Genre::class);
  }

  public function publisher()
  {
    return $this->belongsTo(Publisher::class);
  }

  public function language()
  {
    return $this->belongsTo(Language::class);
  }

  public function author()
  {
    return $this->belongsTo(Author::class);
  }

  public function purchases()
  {
    return $this->belongsToMany(Purchase::class);
  }

  public function carts()
  {
    return $this->belongsToMany(Cart::class);
  }
}
