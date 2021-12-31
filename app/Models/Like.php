<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
  public function game()
  {
    return $this->belongsTo('App\Models\Game');
  }
  use HasFactory;

  public function user(){
    return $this->belongsTo(User::class);
  }
}
