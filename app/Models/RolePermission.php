<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
  public function permission()
  {
    return $this->belongsTo('App\Models\Permission');
  }
  public function role()
  {
    return $this->belongsTo('App\Models\Role');
  }
  use HasFactory;
}
