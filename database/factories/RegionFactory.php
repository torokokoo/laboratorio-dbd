<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->state(),
            'country_id' => Country::all()->random()->id
        ];
    }
}
