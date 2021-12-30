<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
  public function transactionCurrency()
  {
    return $this->hasMany('App\Models\TransactionCurrency');
  }
  use HasFactory;
}
