<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishListGame extends Model
{
    use HasFactory;

    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }

}
