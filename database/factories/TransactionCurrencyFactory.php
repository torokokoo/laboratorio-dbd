<?php

namespace Database\Factories;

use App\Models\TransactionFactory;
use App\Models\Currency;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionCurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'currency_id' => Currency::all()->random()->id,
            'transaction_id' => Transaction::all()->random()->id

        ];
    }
}
