<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    public $table = 'Countries';
    protected $fillable = [ 'name' ];

    public function users()
    {
      return $this->hasMany(User::class);
    }
}
