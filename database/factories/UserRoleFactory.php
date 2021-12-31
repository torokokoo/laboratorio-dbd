<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;

class UserRoleFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'user_id' => User::all()->random()->id,
      'role_id' => User::all()->random()->id,
    ];
  }
}
