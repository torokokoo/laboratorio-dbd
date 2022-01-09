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
  public function currency()
  {
    return $this->belongsTo('App\Models\Currency');
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

  public function userrole()
  {
    return $this->hasMany(UserRole::class);
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
}
