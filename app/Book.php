<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
  protected $table = 'books';
  protected $fillable = [
    'title', 'total_pages', 'price', 'cover_img_url', 'release_date',
    'genre_id', 'author_id', 'publisher_id', 'language_id', 'ranking',
    'resena', 'isbn', 'created_at', 'updated_at'
  ];

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
    return $this->belongsToMany(Cart::class)->withPivot(['quantity', 'price', 'subtotal']);
  }

  public function favoriteOfUsers()
  {
    return $this->belongsToMany(User::class, 'favorites');
  }
}
