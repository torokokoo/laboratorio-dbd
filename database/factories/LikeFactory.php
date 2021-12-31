<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
<<<<<<< Updated upstream:database/factories/UserFactory.php
            'name'=>$this->faker->name,
            'email'=>$this->faker->safeEmail,
            'password'=>$this->faker->password,
            'birthday'=>$this->faker->date(($format = 'Y-m-d', $max = 'now'),
            'balance'=>$this->faker->numberBetween($min = 0,$max = 100000000),
=======
        'like' => $this->faker->boolean
>>>>>>> Stashed changes:database/factories/LikeFactory.php

        ];
    }
}
