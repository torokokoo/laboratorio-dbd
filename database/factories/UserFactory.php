<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\User;
use App\Models\HomeAddress;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array
   */
  public function definition()
  {
    return [
      'name' => $this->faker->name,
      'email' => $this->faker->safeEmail,
      'password' => $this->faker->password,
      'birthday' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
      'balance' => $this->faker->numberBetween($min = 0, $max = 100000000),
      'currency_id' => Currency::all()->random()->id,
      'country_id' => Currency::all()->random()->id,
      'role_id'  => Role::all()->random()->id,
      'home_address_id' => HomeAddress::all()->random()->id
    ];
  }
}
