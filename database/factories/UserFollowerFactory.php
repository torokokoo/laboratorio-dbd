<?php

namespace Database\Factories;

use App\Models\UserFollower;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFollowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user1_id' => User::all()->random()->id,
            'user2_id' => User::all()->random()->id
        ];
    }
}
