<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;

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
      'role_id' => Role::all()->random()->id,
      'permission_id' => Permission::all()->random()->id,
    ];
  }
}
