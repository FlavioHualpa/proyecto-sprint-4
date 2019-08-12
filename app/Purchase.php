<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
  protected $table = 'purchases';
  protected $fillable = [ 'user_id', 'invoice_number' ];

  public function books()
  {
    return $this->belongsToMany(Book::class)->withPivot(['quantity', 'price', 'subtotal']);
  }

}
