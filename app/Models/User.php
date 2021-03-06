<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
  use HasFactory;
  public function message()
  {
    return $this->hasMany(Message::class);
  }

  public function homeAddress()
  {
    return $this->belongsTo('App\Models\HomeAddress');
  }
  public function messagetwo()
  {
    return $this->hasMany(Message::class);
  }

  public function userfollower()
  {
    return $this->hasMany(UserFollower::class);
  }
  public function userfollowertwo()
  {
    return $this->hasMany(UserFollower::class);
  }

  public function role()
  {
    return $this->hasOne('App\Models\Role');
  }
  public function library()
  {
    return $this->hasOne(Library::class);
  }

  public function like()
  {
    return $this->hasMany(Like::class);
  }

  public function wishlist()
  {
    return $this->hasMany(WishList::class);
  }

  public function comment()
  {
    return $this->hasMany(Comment::class);
  }

  public function transaction()
  {
    return $this->hasMany(Transaction::class);
  }

  public function currency()
  {
    return $this->hasMany('App\Models\Currency');
  }
}
