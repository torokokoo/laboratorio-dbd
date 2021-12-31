<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
  public function game()
  {
    return $this->hasMany('App\Models\Game');
  }
  public function user(){
    return $this->belongsTo(User::class)
  }
  use HasFactory;
}
