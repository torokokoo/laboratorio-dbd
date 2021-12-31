<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  use HasFactory;

  public function transactionCurrency()
  {
    return $this->hasMany('App\Models\TransactionCurrency');
  }

 
  public function user()
  {
    return $this->belongsTo(User::class)
  }
  
  
  public function game()
  {
    return $this->hasMany('App\Models\Game');
  }
}
