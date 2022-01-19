<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory;

  public function user_role()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function rolePermission()
  {
    return $this->hasMany('App\Models\RolePermission');
  }
  public function role()
  {
    return $this->belongsTo('App\Models\User');
  }
}
