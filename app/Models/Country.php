<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function countryGame(){
        return $this->hasMany('App\Models\CountryGame');
    }

    public function region(){
        return $this->hasMany('App\Models\Region');
    }
}
