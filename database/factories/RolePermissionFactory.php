<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RolePermission;
use App\Models\Role;
use App\Models\Permission;

class RolePermissionFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'permission_id' => Permission::all()->random()->id,
      'role_id' => Role::all()->random()->id
    ];
  }
}
