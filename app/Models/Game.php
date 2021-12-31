<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    public function comment()
    {
    return $this->hasMany('App\Models\Comment');
    }

    public function library()
    {
      return $this->belongsTo('App\Models\Library');
    }

    public function like()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function transaction()
    {
      return $this->belongsTo('App\Models\Transaction');
    }
    public function demo()
    {
        return $this->belongsTo('App\Models\Demo');
    }

    public function url()
    {
        return $this->belongsTo('App\Models\Url');
    }

    public function gamegender()
    {
        return $this->hasMany('App\Models\GameGender');
    }

    public function wish_listgame()
    {
        return $this->hasMany('App\Models\Wish_ListGame');
    }

    public function countrygame()
    {
        return $this->hasMany('App\Models\CountryGame');
    }

    public function agerestriction()
    {
        return $this->belongsTo('App\Models\AgeRestriction');
    }

}
