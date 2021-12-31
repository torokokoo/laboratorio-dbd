<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
  //esta función no iría abajo del hasfactory????'
  public function transactionCurrency()
  {
    return $this->hasMany('App\Models\TransactionCurrency');
  }
  use HasFactory;

  public function user(){
    return $this->belongsTo(User::class)
  }
}
