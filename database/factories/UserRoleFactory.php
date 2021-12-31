<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UserRole;
use App\Models\User;
use App\Models\Role;

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
      'role_id' => User::all()->random()->id
    ];
  }
}
