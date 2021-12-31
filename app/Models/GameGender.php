<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameGender extends Model
{
    use HasFactory;
    public function game()
    {
        return $this->belongsTo('App\Models\Game');
    }

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender');
    }
}
