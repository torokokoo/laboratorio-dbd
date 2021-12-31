<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public function class(){
        return $this->hasMany(Message::class);
    }

    public function userfollower(){
        return $this->belongsTo(UserFollower::class);
    }
    public function userrole(){
        return $this->hasMany(UserRole::class);
    }
    public function library(){
        return $this->hasOne(Library::class);
    }

    public function like(){
        return $this->hasOne(Like::class);
    }

    public function wishlist(){
        return $this->hasMany(WishList::class);
    }

    public function comment(){
        return $this->hasMany(comment::class);
    }
    
    public function transaction(){
        return $this->hasMany(Transaction::class);
    }

}
