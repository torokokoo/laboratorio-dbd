<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wish_ListGame extends Model
{
    use HasFactory;

    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }

}
