<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionCurrency extends Model
{
  public function transaction()
  {
    return $this->belongsTo('App\Models\Transaction');
  }
  public function currency()
  {
    return $this->belongsTo('App\Models\Currency');
  }
  use HasFactory;
}
